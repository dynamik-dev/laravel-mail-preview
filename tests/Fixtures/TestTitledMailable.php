<?php

namespace DynamikDev\MailPreview\Tests\Fixtures;

use DynamikDev\MailPreview\Attributes\PreviewableTitle;
use DynamikDev\MailPreview\Contracts\Previewable;

#[PreviewableTitle('Welcome to the Batcave')]
class TestTitledMailable extends TestMailable implements Previewable {}
