<?php

namespace DynamikDev\MailPreview\Tests\Fixtures;

use DynamikDev\MailPreview\Contracts\Previewable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TestMailable extends Mailable implements Previewable
{
    public function __construct(public string $name) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Mailable',
            from: new Address('test@example.com', 'Test'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: 'Hello '.$this->name,
        );
    }

    public static function toPreview(): self
    {
        return new self('Batman');
    }
}
