<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Notifications\OtpSignupNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class OtpService
{
    const TTL_MINUTES = 10;
    const MAX_ATTEMPTS = 5;
    const RESEND_COOLDOWN_SECONDS = 60;

    protected function cacheKey(string $email): string
    {
        return 'otp:signup:' . strtolower($email);
    }

    public function initiateSignup(array $data): array
    {
        $email = $data['email'];
        $key = $this->cacheKey($email);
        $existing = Cache::get($key);

        if ($existing && now()->diffInSeconds($existing['last_sent_at']) < self::RESEND_COOLDOWN_SECONDS) {
            return [
                'success' => false,
                'reason' => 'cooldown',
                'seconds_remaining' => self::RESEND_COOLDOWN_SECONDS - now()->diffInSeconds($existing['last_sent_at']),
            ];
        }

        $code = (string) random_int(100000, 999999);

        $payload = [
            'code_hash' => Hash::make($code),
            'name' => $data['name'],
            'email' => $email,
            'password_hash' => Hash::make($data['password']),
            'attempts' => 0,
            'max_attempts' => self::MAX_ATTEMPTS,
            'last_sent_at' => now(),
            'temp_user_id' => $data['temp_user_id'] ?? null,
            'referral_code' => $data['referral_code'] ?? null,
            'created_at' => now(),
        ];

        Cache::put($key, $payload, now()->addMinutes(self::TTL_MINUTES));

        try {
            Notification::route('mail', $email)->notify(new OtpSignupNotification($email, $code));
        } catch (\Throwable $th) {
            Cache::forget($key);
            return ['success' => false, 'reason' => 'mail_failed'];
        }

        return ['success' => true];
    }

    public function verify(string $email, string $code): array
    {
        $key = $this->cacheKey($email);
        $payload = Cache::get($key);

        if (!$payload) {
            return ['success' => false, 'reason' => 'expired'];
        }

        if ($payload['attempts'] >= $payload['max_attempts']) {
            return ['success' => false, 'reason' => 'max_attempts'];
        }

        if (!Hash::check($code, $payload['code_hash'])) {
            $payload['attempts']++;
            Cache::put($key, $payload, now()->addMinutes(self::TTL_MINUTES));

            return [
                'success' => false,
                'reason' => 'invalid_code',
                'attempts_remaining' => $payload['max_attempts'] - $payload['attempts'],
            ];
        }

        $user = User::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => $payload['password_hash'],
            'email_verified_at' => now(),
        ]);

        if ($payload['temp_user_id'] !== null) {
            Cart::where('temp_user_id', $payload['temp_user_id'])
                ->update([
                    'user_id' => $user->id,
                    'temp_user_id' => null,
                ]);
        }
        Session::forget('temp_user_id');

        if ($payload['referral_code'] !== null) {
            $referredBy = User::where('referral_code', $payload['referral_code'])->first();
            if ($referredBy !== null) {
                $user->referred_by = $referredBy->id;
                $user->save();
            }
        }

        Cache::forget($key);

        return ['success' => true, 'user' => $user];
    }

    public function resend(string $email): array
    {
        $key = $this->cacheKey($email);
        $payload = Cache::get($key);

        if (!$payload) {
            return ['success' => false, 'reason' => 'no_pending_signup'];
        }

        $secondsSinceLastSent = now()->diffInSeconds($payload['last_sent_at']);
        if ($secondsSinceLastSent < self::RESEND_COOLDOWN_SECONDS) {
            return [
                'success' => false,
                'reason' => 'cooldown',
                'seconds_remaining' => self::RESEND_COOLDOWN_SECONDS - $secondsSinceLastSent,
            ];
        }

        $code = (string) random_int(100000, 999999);
        $payload['code_hash'] = Hash::make($code);
        $payload['attempts'] = 0;
        $payload['last_sent_at'] = now();

        Cache::put($key, $payload, now()->addMinutes(self::TTL_MINUTES));

        try {
            Notification::route('mail', $email)->notify(new OtpSignupNotification($email, $code));
        } catch (\Throwable $th) {
            return ['success' => false, 'reason' => 'mail_failed'];
        }

        return ['success' => true];
    }
}
