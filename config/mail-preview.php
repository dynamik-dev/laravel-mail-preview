<?php

return [

    /**
     * Enable or disable the mail preview
     */
    'enabled' => env('MAIL_PREVIEW_ENABLED', false),

    /**
     * The route prefix for the mail preview
     */
    'route_prefix' => env('MAIL_PREVIEW_ROUTE_PREFIX', 'mail'),

    /**
     * The path to discover mailables in.
     */
    'discover_path' => env('MAIL_PREVIEW_DISCOVER_PATH', base_path('app')),
];
