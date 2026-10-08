<?php

namespace DynamikDev\MailPreview\Controllers;

use DynamikDev\MailPreview\MailPreview;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class MailPreviewController extends Controller
{
    public function __construct(
        protected MailPreview $mailPreview
    ) {}

    public function show(string $slug): ?Renderable
    {
        return $this->mailPreview->render($slug);
    }

    public function list(): View
    {
        $list = $this->mailPreview->getPreviewableClasses()->map(function (string $class) {
            return [
                'slug' => $this->mailPreview->slug($class),
                'title' => $this->mailPreview->title($class),
            ];
        });

        return view('mail-preview::list', ['list' => $list]);
    }
}
