<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
         $newuser = $event->newuser;

       $newuser = User::where('id',$event->newuser->id)->first();
        Mail::send('mail', ['name' => $newuser->name, 'phone' => $newuser->phone, 'email' => $newuser->email, 'role' => $newuser->role],
         function($message) use ($newuser) {
            $message->from('admin@bands.com','Admin');
            $message->to($newuser->email);
            $message->subject('Customer Registration');
            // $message->attach(public_path('/images/others/banner.png'));
        });
    }
}
