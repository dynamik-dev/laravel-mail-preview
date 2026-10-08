<?php

namespace DynamikDev\MailPreview\Contracts;

/**
 * Prefer the #[Previewable] attribute when the package is installed as a dev dependency.
 * A class implementing this interface fails to load when the package is not installed.
 *
 * @see \DynamikDev\MailPreview\Attributes\Previewable
 */
interface Previewable
{
    /**
     * @return static
     */
    public static function toPreview(): self;
}
