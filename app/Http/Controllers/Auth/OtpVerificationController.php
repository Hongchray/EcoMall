<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OtpVerificationController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->middleware('guest');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        $this->otpService = $otpService;
    }

    public function show(Request $request)
    {
        $email = session('otp_pending_email');

        if (!$email) {
            flash(translate('Please register first.'))->error();
            return redirect()->route('user.registration');
        }

        return view('auth.verify_otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $email = session('otp_pending_email');

        if (!$email) {
            flash(translate('Please register first.'))->error();
            return redirect()->route('user.registration');
        }

        $result = $this->otpService->verify($email, $request->code);

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
                    flash(translate('Your verification session has expired. Please register again.'))->error();
                    return redirect()->route('user.registration');
            }

            return back();
        }

        Session::forget('otp_pending_email');
        Auth::login($result['user']);

        flash(translate('Registration successful.'))->success();

        if (session('link') != null) {
            return redirect(session('link'));
        }

        return redirect()->route('home');
    }

    public function resend(Request $request)
    {
        $email = session('otp_pending_email');

        if (!$email) {
            flash(translate('Please register first.'))->error();
            return redirect()->route('user.registration');
        }

        $result = $this->otpService->resend($email);

        if (!$result['success']) {
            switch ($result['reason']) {
                case 'no_pending_signup':
                    flash(translate('Please register again.'))->error();
                    return redirect()->route('user.registration');
                case 'cooldown':
                    flash(translate('Please wait before requesting another code. Seconds remaining: ') . $result['seconds_remaining'])->error();
                    break;
                case 'mail_failed':
                default:
                    flash(translate('Failed to send verification code. Please try again later.'))->error();
            }

            return back();
        }

        flash(translate('A new verification code has been sent to your email.'))->success();
        return back();
    }
}
