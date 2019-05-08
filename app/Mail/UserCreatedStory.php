<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedStory extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $story;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($story,$admin)
    {
        //
        $this->story=$story;
        $this->admin=$admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user_created_story')
                    ->from('info@kidstories.app');
    }
}
