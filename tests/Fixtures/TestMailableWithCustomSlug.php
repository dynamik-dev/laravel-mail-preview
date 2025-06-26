<?php

namespace DynamikDev\MailPreview\Tests\Fixtures;

use DynamikDev\MailPreview\Contracts\Previewable;

class TestMailableWithCustomSlug extends TestMailable implements Previewable
{
    public static $previewSlug = 'test-mailable-with-custom-slug';
}
