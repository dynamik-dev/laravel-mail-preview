<?php

use DynamikDev\MailPreview\Controllers\MailPreviewController;
use Illuminate\Support\Facades\Route;

$prefix = config('mail-preview.route_prefix');

Route::prefix($prefix)->group(function () {

    Route::get('/{slug}', [MailPreviewController::class, 'show'])->name('mail-preview.show');
});
