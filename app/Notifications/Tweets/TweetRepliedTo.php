<?php

namespace App\Notifications\Tweets;

use App\Http\Resources\Tweet\TweetsResource;
use App\Http\Resources\User\UserResource;
use App\User;
use App\Tweet;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\DatabaseNotificationChannel;
use Illuminate\Notifications\Messages\MailMessage;

class TweetRepliedTo extends Notification
{
    use Queueable;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $user;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $tweet;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Tweet $tweet)
    {
        $this->user = $user;
        $this->tweet = $tweet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            DatabaseNotificationChannel::class
        ];
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
            'user' => new UserResource($this->user),
            'tweet' => new TweetsResource($this->tweet),
        ];
    }
}
