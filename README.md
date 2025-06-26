# Laravel Mail Preview

A utility for viewing emails in your browser as you develop with Laravel. This package allows you to preview your mailables without actually sending emails, making it easier to develop and test your email templates.

## Features

- 🔍 **Auto-discovery** of mailables that implement the `Previewable` interface
- 🌐 **Web-based preview** - view emails directly in your browser
- 🎨 **Template testing** - test your email templates with sample data
- ⚡ **Development-friendly** - only enabled in development environments
- 🔧 **Configurable** - customize discovery paths and route prefixes

## Requirements

- PHP 8.4+
- Laravel 10.x, 11.x, or 12.x

## Installation

You can install the package via Composer:

```bash
composer require dynamik-dev/laravel-mail-preview --dev
```

The package will automatically register itself with Laravel.

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="DynamikDev\MailPreview\MailPreviewServiceProvider"
```

This will create a `config/mail-preview.php` file with the following options:

```php
return [
    // Enable or disable the mail preview
    'enabled' => env('MAIL_PREVIEW_ENABLED', false),
    
    // The route prefix for the mail preview
    'route_prefix' => env('MAIL_PREVIEW_ROUTE_PREFIX', 'mail'),
    
    // The path to discover mailables in
    'discover_path' => env('MAIL_PREVIEW_DISCOVER_PATH', base_path('app')),
];
```

### Environment Variables

Add these to your `.env` file:

```env
MAIL_PREVIEW_ENABLED=true
MAIL_PREVIEW_ROUTE_PREFIX=mail
MAIL_PREVIEW_DISCOVER_PATH=/path/to/your/app
```

## Usage

### 1. Make Your Mailable Previewable

To make a mailable previewable, implement the `Previewable` interface and add the `toPreview()` method:

```php
<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use DynamikDev\MailPreview\Contracts\Previewable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;

class WelcomeEmail extends Mailable implements Previewable
{
    public function __construct(public string $name)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Our Platform',
            from: new Address('welcome@example.com', 'Our Team'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: view('emails.welcome', ['name' => $this->name])->render(),
        );
    }

    /**
     * Create a preview instance of this mailable
     */
    public static function toPreview(): self
    {
        return new self('John Doe');
    }
}
```

### 2. View Your Email Preview

Once you've made your mailable previewable, you can view it in your browser at:

```
http://your-app.test/mail/welcome-email
```

The URL slug is automatically generated from your class name:
- `WelcomeEmail` → `welcome-email`
- `OrderConfirmationMail` → `order-confirmation-mail`
- `TestMailable` → `test-mailable`

### 3. Custom Preview Slugs

You can also define a custom preview slug by adding a static property to your mailable:

```php
class WelcomeEmail extends Mailable implements Previewable
{
    public static string $previewSlug = 'welcome';
    
    // ... rest of your mailable code
}
```

Now you can access it at: `http://your-app.test/mail/welcome`

## Advanced Usage

### Using the Facade

You can also use the `MailPreview` facade to programmatically render mailables:

```php
use DynamikDev\MailPreview\Facades\MailPreview;

// Render a mailable by slug
$html = MailPreview::render('welcome-email');

// Get all previewable classes
$classes = MailPreview::getPreviewableClasses();
```

### Custom Discovery Paths

You can configure multiple discovery paths by modifying the config:

```php
'discover_path' => [
    base_path('app/Mail'),
    base_path('app/Notifications'),
],
```

## Security

**Important**: This package should only be enabled in development environments. The mail preview routes expose your email templates and could potentially leak sensitive information.

Make sure to:

1. Set `MAIL_PREVIEW_ENABLED=false` in production
2. Add the preview routes to your middleware if needed
3. Consider using authentication middleware for the preview routes

## Testing

Run the test suite:

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Credits

- [Chris Arter](https://github.com/chrisarter)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
