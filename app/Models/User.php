<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the phone number for the user.
     *
     * @return string|null
     */
    public function getPhoneNumberForPasswordReset(): ?string
    {
        return $this->phone_number;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @param  string  $channel 'email' or 'sms'
     * @return void
     */
    public function sendPasswordResetNotification($token, $channel = 'email'): void
    {
        if ($channel === 'sms') {
            $this->notify(new \App\Notifications\ResetPasswordByPhone($token));
        } else {
            // Default email notification, using our custom localized mailable
            $this->notify(new \App\Notifications\PasswordResetLinkSent($token));
        }
    }
}
