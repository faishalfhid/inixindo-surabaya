<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Participant;

class ParticipantInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public Participant $participant;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function build()
    {
        $url = route('participant.confirm.show', $this->participant->token);

        return $this->subject('Undangan Konfirmasi Pelatihan')
                    ->view('emails.participant_invitation')
                    ->with([
                        'participant' => $this->participant,
                        'url' => $url,
                    ]);
    }
}
