<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailLawyerRappelDelais extends Mailable
{
    use Queueable, SerializesModels;

    public  $recours;
    public  $user;
    public $joursRestants;

    public function __construct($recours, $user, $joursRestants)
    {

        $this->recours = $recours;
        $this->user = $user;
        $this->joursRestants = $joursRestants;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rappel Delais' . ' ' . 'pour le dossier' . ' ' . 'N°' . $this->recours->numero_dossier,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.mail-lawyer-rappel-delais',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
