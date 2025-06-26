<?php

namespace DynamikDev\MailPreview\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DynamikDev\MailPreview\MailPreview
 */
class MailPreview extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \DynamikDev\MailPreview\MailPreview::class;
    }
}
