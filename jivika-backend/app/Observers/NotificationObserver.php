<?php

namespace App\Observers;

use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use stdClass;

class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        $this->sendEmail($notification);
    }


    private function sendEmail($notification)
    {
        $toUser = $notification->receiver;
        $emailContent = [
            'title' => $notification->title,
            'body' => $notification->body
        ];
        
        // Send email directly without using a view file
        Mail::raw($emailContent['body'], function ($message) use ($toUser, $emailContent) {
            $message->to($toUser->email)
                    ->subject($emailContent['title']);
        });
    }

    // private function sendSMS(Notification $notification)
    // {
    //     NotificationService::sendSMS($notification);
    // }

    // private function sendFirebase(Notification $notification)
    // {
    //     Log::info("Notification Sending");
    //     $this->sendNotification($notification->user, $notification);
    //     Log::info("Notification Sent");
    // }
    /**
     * Handle the Notification "updated" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function updated(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function deleted(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "restored" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function restored(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "force deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function forceDeleted(Notification $notification)
    {
        //
    }
}
