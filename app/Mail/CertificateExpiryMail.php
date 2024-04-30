<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateExpiryMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(private readonly Collection $members)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rathdrum OMAC Members Certificate Expiry Report',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.CertificateExpiryMail',
            with: ['members' => $this->members],
        );
    }
}
