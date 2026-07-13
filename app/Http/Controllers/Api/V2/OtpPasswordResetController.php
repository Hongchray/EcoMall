<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtpPasswordResetController extends Controller
{
    // Page 1: enter email, send OTP code
    public function requestCode(Request $request)
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

        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'result' => false,
                'message' => translate('No account exists with this email'),
            ], 404);
        }

        $otpService = new OtpService();
        $result = $otpService->initiatePasswordReset($request->email);

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

    // Page 2: verify OTP code
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
        $result = $otpService->verifyResetCode($request->email, $request->code);

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
                    $message = translate('Your verification session has expired. Please request a new code.');
                    $status = 410;
            }

            return response()->json([
                'result' => false,
                'message' => $message,
            ], $status);
        }

        return response()->json([
            'result' => true,
            'message' => translate('Code verified. You can now set a new password.'),
        ], 200);
    }

    // Page 3: set new password
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $otpService = new OtpService();
        $result = $otpService->completePasswordReset($request->email, $request->password);

        if (!$result['success']) {
            return response()->json([
                'result' => false,
                'message' => translate('Your verification session has expired. Please request a new code.'),
            ], 410);
        }

        return response()->json([
            'result' => true,
            'message' => translate('Your password has been reset successfully'),
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
        $result = $otpService->initiatePasswordReset($request->email);

        if (!$result['success']) {
            if ($result['reason'] === 'cooldown') {
                return response()->json([
                    'result' => false,
                    'message' => translate('Please wait before requesting another code.'),
                    'seconds_remaining' => $result['seconds_remaining'],
                ], 429);
            }

            return response()->json([
                'result' => false,
                'message' => translate('Failed to send verification code. Please try again later.'),
            ], 500);
        }

        return response()->json([
            'result' => true,
            'message' => translate('A new verification code has been sent to your email'),
        ], 200);
    }
}
