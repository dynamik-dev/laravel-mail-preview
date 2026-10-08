<?php

namespace DynamikDev\MailPreview;

use DynamikDev\MailPreview\Attributes\PreviewableTitle;
use DynamikDev\MailPreview\Concerns\FindsMailables;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use ReflectionClass;

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

    /**
     * Get the listing title for a class, from its PreviewableTitle attribute or falling back to its slug.
     */
    public function title(string $class): string
    {
        if (class_exists($class)) {
            $attributes = (new ReflectionClass($class))->getAttributes(PreviewableTitle::class);

            if ($attributes !== []) {
                return $attributes[0]->newInstance()->title;
            }
        }

        return $this->slug($class);
    }

    public function slug(string $class): string
    {
        return Str::kebab(class_basename($class));
    }
}
