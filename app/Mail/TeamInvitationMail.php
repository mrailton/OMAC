<?php

namespace App\Mail;

use App\Models\Invitation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class TeamInvitationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private Invitation $invitation;

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation to join ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.team-invitation',
            with: [
                'acceptUrl' => URL::signedRoute(
                    "invitation.accept",
                    ['invitation' => $this->invitation]
                ),
            ]
        );
    }
}
