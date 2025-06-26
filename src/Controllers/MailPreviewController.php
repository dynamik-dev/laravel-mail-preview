<?php

namespace DynamikDev\MailPreview\Controllers;

use DynamikDev\MailPreview\MailPreview;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MailPreviewController extends Controller
{
    public function __construct(
        protected MailPreview $mailPreview
    ) {}

    public function show(Request $request, string $slug)
    {
        return $this->mailPreview->render($slug);
    }
}
