<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use App\Mail\SecondEmailVerifyMailManager;
use App\Services\OtpService;
use App\Utility\SmsUtility;
use Illuminate\Support\Facades\Session;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $phone = "+{$request['country_code']}{$request['phone']}";
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->email)->first();
            if ($user != null) {
                $otpService = new OtpService();
                $result = $otpService->initiatePasswordReset($request->email);

                if (!$result['success']) {
                    if ($result['reason'] === 'cooldown') {
                        flash(translate('A code was already sent. Please wait before requesting another. Seconds remaining: ') . $result['seconds_remaining'])->error();
                        session(['otp_reset_email' => $request->email]);
                        return redirect()->route('password.reset.verify_code');
                    }

                    flash(translate('We could not send the verification email. Please check your email address and try again, or try again later.'))->error();
                    return back();
                }

                session(['otp_reset_email' => $request->email]);
                return redirect()->route('password.reset.verify_code');
            }
            else {
                flash(translate('No account exists with this email'))->error();
                return back();
            }
        }
        else{
            $user = User::where('phone', $phone)->first();
            if ($user != null) {
                $user->verification_code = rand(100000,999999);
                $user->save();
                SmsUtility::password_reset($user);
                return view('otp_systems.frontend.auth.passwords.reset_with_phone');
            }
            else {
                flash(translate('No account exists with this phone number'))->error();
                return back();
            }
        }
    }

    public function showVerifyCode(Request $request)
    {
        $email = session('otp_reset_email');

        if (!$email) {
            flash(translate('Please request a password reset code first.'))->error();
            return redirect()->route('password.request');
        }

        return view('auth.passwords.verify_reset_code', compact('email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $email = session('otp_reset_email');

        if (!$email) {
            flash(translate('Please request a password reset code first.'))->error();
            return redirect()->route('password.request');
        }

        $otpService = new OtpService();
        $result = $otpService->verifyResetCode($email, $request->code);

        \Illuminate\Support\Facades\Log::info('verifyCode debug', ['email' => $email, 'code' => $request->code, 'result' => $result]);

        if (!$result['success']) {
            switch ($result['reason']) {
                case 'max_attempts':
                    flash(translate('Too many incorrect attempts. Please request a new code.'))->error();
                    break;
                case 'invalid_code':
                    flash(translate('Incorrect code. Attempts remaining: ') . $result['attempts_remaining'])->error();
                    break;
                case 'expired':
                default:
                    flash(translate('Your verification session has expired. Please request a new code.'))->error();
                    return redirect()->route('password.request');
            }

            return back();
        }

        return redirect()->route('password.reset.set_new_password');
    }

    public function resendCode(Request $request)
    {
        $email = session('otp_reset_email');

        if (!$email) {
            flash(translate('Please request a password reset code first.'))->error();
            return redirect()->route('password.request');
        }

        $otpService = new OtpService();
        $result = $otpService->initiatePasswordReset($email);

        if (!$result['success']) {
            switch ($result['reason']) {
                case 'cooldown':
                    flash(translate('Please wait before requesting another code. Seconds remaining: ') . $result['seconds_remaining'])->error();
                    break;
                default:
                    flash(translate('Failed to send verification code. Please try again later.'))->error();
            }

            return back();
        }

        flash(translate('A new verification code has been sent to your email.'))->success();
        return back();
    }

    public function showSetNewPassword(Request $request)
    {
        $email = session('otp_reset_email');

        if (!$email) {
            flash(translate('Please request a password reset code first.'))->error();
            return redirect()->route('password.request');
        }

        return view('auth.passwords.set_new_password');
    }

    public function completeReset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $email = session('otp_reset_email');

        if (!$email) {
            flash(translate('Please request a password reset code first.'))->error();
            return redirect()->route('password.request');
        }

        $otpService = new OtpService();
        $result = $otpService->completePasswordReset($email, $request->password);

        \Illuminate\Support\Facades\Log::info('completeReset debug', ['email' => $email, 'result' => $result]);

        if (!$result['success']) {
            flash(translate('Your verification session has expired. Please request a new code.'))->error();
            return redirect()->route('password.request');
        }

        Session::forget('otp_reset_email');

        $user = $result['user'];
        event(new PasswordReset($user));
        auth()->login($user, true);

        return view('auth.passwords.reset_complete');
    }
}
