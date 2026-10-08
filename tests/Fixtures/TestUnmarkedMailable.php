<?php

namespace DynamikDev\MailPreview\Tests\Fixtures;

use Illuminate\Mail\Mailable;

class TestUnmarkedMailable extends Mailable
{
    public static function toPreview(): self
    {
        return new self;
    }
}
