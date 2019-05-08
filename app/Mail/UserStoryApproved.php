<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserStoryApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $story;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($story,$user)
    {
        //
        $this->story=$story;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user_story_approved')
                    ->from('info@kidstories.app')
                    ->subject('Your story has been approved!');
    }
}
