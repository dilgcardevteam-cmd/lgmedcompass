<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;   // <-- add this line

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(config('app.url').route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // Use your custom blade view
        return (new MailMessage)
            ->subject('Reset Your Password')
            ->view('emails.forgot-password', [
                'user' => $notifiable,
                'resetUrl' => $resetUrl,
                'logoUrl' => $this->logoUrl(),
                'logoPath' => $this->logoPath(),
            ]);
    }

    private function logoPath(): ?string
    {
        $logoPath = public_path('images/lgmed-logo-email.png');

        return is_file($logoPath) ? $logoPath : null;
    }

    private function logoUrl(): ?string
    {
        $applicationUrl = Config::get('app.url');

        return $applicationUrl ? rtrim($applicationUrl, '/').'/images/lgmed-logo-email.png' : null;
    }
}
