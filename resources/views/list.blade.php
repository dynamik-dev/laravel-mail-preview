<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail Preview</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
            background: #f5f5f5;
            color: #1f2937;
        }

        main {
            width: 100%;
            max-width: 32rem;
            padding: 2rem;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0 0 1rem;
            font-size: 1.25rem;
            text-align: center;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li + li {
            border-top: 1px solid #e5e7eb;
        }

        a {
            display: block;
            padding: 0.75rem 0.5rem;
            color: #2563eb;
            text-decoration: none;
        }

        a:hover {
            background: #f9fafb;
        }
    </style>
</head>
<body>
<main>
    <h1>Mail Preview</h1>

    <ul>
        @forelse ($list as $slug)
            <li>
                <a href="{{ route('mail-preview.show', ['slug' => $slug]) }}">{{ $slug }}</a>
            </li>
        @empty
            <li><a>No previewable mailables found.</a></li>
        @endforelse
    </ul>
</main>
</body>
</html>
