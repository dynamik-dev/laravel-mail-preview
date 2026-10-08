<?php

namespace DynamikDev\MailPreview\Tests;

use DynamikDev\MailPreview\MailPreviewServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected bool $mailPreviewEnabled = true;

    protected function getPackageProviders($app)
    {
        return [
            MailPreviewServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('mail-preview.enabled', $this->mailPreviewEnabled);
    }
}
