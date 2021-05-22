<?php

namespace App\Mail;

use App\Models\Score;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Morilog\Jalali\Jalalian;

class CVEAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;
    /**
     * @var Score
     */
    private $score;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Score $score
     */
    public function __construct(User $user,Score $score)
    {
        //
        $this->user = $user;
        $this->score = $score;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $desc = '';
        switch ($this->score->score_desc)
        {
            case 'low':
                $desc = 'کم';
                break;
            case 'medium':
                $desc = 'متوسط';
                break;
            case 'high':
                $desc = 'بالا';
                break;
        }
        return $this->subject('اعلان آسیب پذیری جدید با درجه خطر '.$desc)
            ->markdown('Mail.CVEAlert',[
                'url' => route('documents.show',$this->score->content->doc->id),
                'nvd_url' => $this->score->content->doc->nvd_url,
                'cve_name' =>   $this->score->content->doc->slug,
                'desc' => $desc,
                'brand' => $this->score->content->brands->first()->name ?? ' - ',
                'date' => \Morilog\Jalali\Jalalian::forge($this->score->content->published_date)->format('%A, %d %B %Y')
            ]);
    }
}
