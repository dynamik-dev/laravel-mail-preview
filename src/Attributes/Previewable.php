<?php

namespace DynamikDev\MailPreview\Attributes;

use Attribute;

/**
 * Marks a class as previewable. The class must define a static toPreview() method.
 *
 * Unlike the Previewable interface, PHP does not resolve attribute classes when the
 * marked class is loaded, so this is safe to use when the package is installed as a
 * dev dependency and absent in production.
 */
#[Attribute(Attribute::TARGET_CLASS)]
final class Previewable {}
