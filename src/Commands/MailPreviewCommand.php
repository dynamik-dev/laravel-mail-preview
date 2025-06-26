<?php

namespace DynamikDev\MailPreview\Commands;

use Illuminate\Console\Command;

class MailPreviewCommand extends Command
{
    public $signature = 'laravel-mail-preview';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
