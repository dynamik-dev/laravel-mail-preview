<?php

namespace DynamikDev\MailPreview\Concerns;

use DynamikDev\MailPreview\Contracts\Previewable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Spatie\StructureDiscoverer\Discover;

trait FindsMailables
{
    /**
     * Get all classes that implement the Previewable interface
     *
     * @return Collection<int, string>
     */
    public function getPreviewableClasses(): Collection
    {
        $discoverPath = config('mail-preview.discover_path');

        if (! is_string($discoverPath)) {
            throw new InvalidArgumentException('The [mail-preview.discover_path] config value must be a string.');
        }

        $structures = Discover::in($discoverPath)->implementing(Previewable::class)->get();

        return collect(array_values(array_filter($structures, 'is_string')));
    }

    /**
     * Find a class by the class name as a slug without the namespace. For example "App\Mail\WelcomeMail" would be "welcome-mail".
     */
    public function findBySlug(string $slug): ?string
    {
        return $this->getPreviewableClasses()->first(function (string $class) use ($slug) {

            $classSlug = Str::kebab(class_basename($class));

            /**
             * @var string|null $previewSlug
             */
            $previewSlug = $class::$previewSlug ?? null;

            return $classSlug === Str::kebab($slug) || $previewSlug === $slug;
        });
    }
}
