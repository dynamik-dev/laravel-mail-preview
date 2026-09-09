<?php

namespace DynamikDev\MailPreview;

use DynamikDev\MailPreview\Concerns\FindsMailables;
use DynamikDev\MailPreview\Contracts\Previewable;

class MailPreview
{
    use FindsMailables;

    public function render(string $slug): ?Previewable
    {
        $class = $this->findBySlug($slug);

        if ($class === null || ! is_subclass_of($class, Previewable::class)) {
            return null;
        }

        return $class::toPreview();
    }
}
