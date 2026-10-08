<?php

namespace DynamikDev\MailPreview\Attributes;

use Attribute;

/**
 * Sets the title shown for a previewable class on the mail preview listing page.
 */
#[Attribute(Attribute::TARGET_CLASS)]
final class PreviewableTitle
{
    public function __construct(
        public string $title,
    ) {}
}
