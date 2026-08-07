<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtpSignupController extends Controller
{
    // Page 1: enter name/email/password, send OTP code
    public function requestCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $otpService = new OtpService();
        $result = $otpService->initiateSignup([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'referral_code' => $request->referral_code,
        ]);

        if (!$result['success']) {
            if ($result['reason'] === 'cooldown') {
                return response()->json([
                    'result' => false,
                    'message' => translate('A code was already sent. Please wait before requesting another.'),
                    'seconds_remaining' => $result['seconds_remaining'],
                ], 429);
            }

            return response()->json([
                'result' => false,
                'message' => translate('We could not send the verification email. Please try again later.'),
            ], 500);
        }

        return response()->json([
            'result' => true,
            'message' => translate('A verification code has been sent to your email'),
        ], 200);
    }

    // Page 2: verify OTP code, creates the account and logs in
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $otpService = new OtpService();
        $result = $otpService->verify($request->email, $request->code);

        if (!$result['success']) {
            $status = 422;
            switch ($result['reason']) {
                case 'max_attempts':
                    $message = translate('Too many incorrect attempts. Please request a new code.');
                    break;
                case 'invalid_code':
                    $message = translate('Incorrect code. Attempts remaining: ') . $result['attempts_remaining'];
                    break;
                case 'expired':
                default:
                    $message = translate('Your verification session has expired. Please register again.');
                    $status = 410;
            }

            return response()->json([
                'result' => false,
                'message' => $message,
            ], $status);
        }

        $user = $result['user'];
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'result' => true,
            'message' => translate('Registration successful'),
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => null,
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'avatar_original' => uploaded_asset($user->avatar_original),
                'phone' => $user->phone,
                'email_verified' => $user->email_verified_at != null,
            ],
        ], 200);
    }

    public function resendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $otpService = new OtpService();
        $result = $otpService->resend($request->email);

        if (!$result['success']) {
            $status = 422;
            switch ($result['reason']) {
                case 'no_pending_signup':
                    $message = translate('Please register again.');
                    $status = 410;
                    break;
                case 'cooldown':
                    $message = translate('Please wait before requesting another code.');
                    $status = 429;
                    break;
                case 'mail_failed':
                default:
                    $message = translate('Failed to send verification code. Please try again later.');
                    $status = 500;
            }

            return response()->json([
                'result' => false,
                'message' => $message,
            ], $status);
        }

        return response()->json([
            'result' => true,
            'message' => translate('A new verification code has been sent to your email'),
        ], 200);
    }
}
