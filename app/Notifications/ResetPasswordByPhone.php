<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordByPhone extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    public function toSms(mixed $notifiable): string
    {
        // Construct the reset URL including locale and phone number
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'phone_number' => $notifiable->getPhoneNumberForPasswordReset(),
            'locale' => app()->getLocale()
        ]));

        return trans('passwords.sms_sent', [], app()->getLocale()) . ' ' . $this->token . '. ' . trans('auth.reset_password', [], app()->getLocale()) . ': ' . $resetUrl;
    }
}
