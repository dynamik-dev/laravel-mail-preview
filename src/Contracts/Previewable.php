<?php

namespace DynamikDev\MailPreview\Contracts;

interface Previewable
{
    /**
     * @return static
     */
    public static function toPreview(): self;
}
