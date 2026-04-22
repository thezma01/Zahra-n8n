<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetLinkSent extends ResetPasswordNotification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        // Construct the reset URL including locale and email
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
            'locale' => app()->getLocale()
        ]));

        return (new MailMessage)
            ->subject(trans('auth.reset_password', [], app()->getLocale()))
            ->line(trans('passwords.sent', [], app()->getLocale()))
            ->action(trans('auth.reset_password', [], app()->getLocale()), $resetUrl)
            ->line(trans('auth.password_confirmation', [], app()->getLocale()));
    }
}
