<?php

namespace DynamikDev\MailPreview\Tests\Fixtures;

use DynamikDev\MailPreview\Attributes\Previewable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

#[Previewable]
class TestAttributeMailable extends Mailable
{
    final public function __construct(public string $name) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Attribute Mailable',
            from: new Address('test@example.com', 'Test'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: 'Hello '.$this->name,
        );
    }

    public static function toPreview(): static
    {
        return new static('Robin');
    }
}
