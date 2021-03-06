<?php


namespace App\Notifications\Tweets;

use App\Http\Resources\Tweet\TweetsResource;
use App\Http\Resources\User\UserResource;
use App\Notifications\DatabaseNotificationChannel;
use App\Tweet;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;


class TweetMentionedIn extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Tweet
     */
    private $tweet;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Tweet $tweet)
    {
        //
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
        return [DatabaseNotificationChannel::class];
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
            'tweet' => new TweetsResource($this->tweet)
        ];
    }

}