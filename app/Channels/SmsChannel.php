<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
// use Twilio\Rest\Client as TwilioClient;
// use Vonage\Client as VonageClient;
// use Vonage\Client\Credentials\Basic as VonageBasic;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send(mixed $notifiable, Notification $notification): void
    {
        $message = $notification->toSms($notifiable);
        $to = $notifiable->getPhoneNumberForPasswordReset();

        if (!$to) {
            Log::warning('SMS notification attempted without a phone number for user ID: ' . $notifiable->id);
            return;
        }

        $driver = config('services.sms.driver');

        switch ($driver) {
            case 'twilio':
                // require_once __DIR__ . '/../../../vendor/autoload.php'; // Ensure Twilio SDK is loaded
                // $sid = config('services.sms.twilio.sid');
                // $token = config('services.sms.twilio.token');
                // $from = config('services.sms.twilio.from');
                // try {
                //     $client = new TwilioClient($sid, $token);
                //     $client->messages->create($to, [
                //         'from' => $from,
                //         'body' => $message,
                //     ]);
                //     Log::info("SMS sent via Twilio to {$to}: {$message}");
                // } catch (\Exception $e) {
                //     Log::error("Failed to send SMS via Twilio to {$to}: " . $e->getMessage());
                // }
                Log::info("SMS (Twilio - mocked) sent to {$to}: {$message}");
                break;
            case 'vonage':
                // require_once __DIR__ . '/../../../vendor/autoload.php'; // Ensure Vonage SDK is loaded
                // $basic  = new VonageBasic(config('services.sms.vonage.key'), config('services.sms.vonage.secret'));
                // $client = new VonageClient($basic);
                // try {
                //     $client->sms()->send(
                //         new \Vonage\SMS\Message\SMS($to, config('services.sms.vonage.from'), $message)
                //     );
                //     Log::info("SMS sent via Vonage to {$to}: {$message}");
                // } catch (\Exception $e) {
                //     Log::error("Failed to send SMS via Vonage to {$to}: " . $e->getMessage());
                // }
                Log::info("SMS (Vonage - mocked) sent to {$to}: {$message}");
                break;
            case 'log':
            default:
                Log::info("SMS (Log Channel) sent to {$to}: {$message}");
                break;
        }
    }
}
