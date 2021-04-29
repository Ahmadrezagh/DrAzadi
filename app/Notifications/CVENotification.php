<?php

namespace App\Notifications;

use App\Mail\CVEAlertMail;
use App\Models\Doc;
use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CVENotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    private $to;
    /**
     * @var Score
     */
    private $score;

    /**
     * Create a new notification instance.
     *
     * @param string $to
     * @param Score $score
     */
    public function __construct(string $to,Score $score)
    {
        //
        $this->to = $to;
        $this->score = $score;
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
        return (new CVEAlertMail($notifiable,$this->score))
            ->to($this->to);
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
