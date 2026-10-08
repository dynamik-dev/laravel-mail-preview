<?php

namespace DynamikDev\MailPreview;

use DynamikDev\MailPreview\Concerns\FindsMailables;
use Illuminate\Contracts\Support\Renderable;

class MailPreview
{
    use FindsMailables;

    public function render(string $slug): ?Renderable
    {
        $class = $this->findBySlug($slug);

        if ($class === null || ! is_callable([$class, 'toPreview'])) {
            return null;
        }

        $preview = call_user_func([$class, 'toPreview']);

        return $preview instanceof Renderable ? $preview : null;
    }
}
