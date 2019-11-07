<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StoryPending extends Notification
{
    use Queueable;
    public $story;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $story)
    {
        $this->user = $user;
        $this->story = $story;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Story Received, Review Pending')
            ->greeting('Hello! ' . $this->user->full_name)
            ->line('You have successfully posted a story to kidstories.')
            ->line('However your story will not be published until after it has been reviewed')
            ->line('You will be notified as soon as your story is approved')
            ->action('Your Story', route('story.show', $this->story->slug))
            ->line('Thank you for choosing kidstories!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
