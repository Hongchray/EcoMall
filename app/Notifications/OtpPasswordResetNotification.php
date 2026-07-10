<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpPasswordResetNotification extends Notification
{
    use Queueable;

    protected $email;
    protected $code;

    public function __construct(string $email, string $code)
    {
        $this->email = $email;
        $this->code = $code;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view('emails.otp_password_reset', ['code' => $this->code])
            ->subject(translate('Password reset code - ') . env('APP_NAME'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
