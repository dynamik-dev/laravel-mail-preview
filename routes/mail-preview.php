<?php

use DynamikDev\MailPreview\Controllers\MailPreviewController;
use Illuminate\Support\Facades\Route;

$prefix = config('mail-preview.route_prefix');

if (! is_string($prefix)) {
    throw new InvalidArgumentException('The [mail-preview.route_prefix] config value must be a string.');
}

Route::prefix($prefix)->group(function () {

    Route::get('/', [MailPreviewController::class, 'list'])->name('mail-preview.list');

    Route::get('/{slug}', [MailPreviewController::class, 'show'])->name('mail-preview.show');
});
