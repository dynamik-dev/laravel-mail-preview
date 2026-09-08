<?php

namespace DynamikDev\MailPreview\Tests\Fixtures;

use DynamikDev\MailPreview\Contracts\Previewable;

class TestMailableWithCustomSlug extends TestMailable implements Previewable
{
    public static string $previewSlug = 'test-mailable-with-custom-slug';
}
