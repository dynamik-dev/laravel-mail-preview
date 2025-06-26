<?php

namespace DynamikDev\MailPreview;

use DynamikDev\MailPreview\Concerns\FindsMailables;

class MailPreview
{
    use FindsMailables;

    public function render(string $slug)
    {

        $class = $this->findBySlug($slug);

        if (! $class) {
            return null;
        }

        return $class::toPreview();
    }
}
