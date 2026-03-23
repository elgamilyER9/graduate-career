<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Graduate Career</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script>
        window.Laravel = {
            user: @json(auth()->user()),
            csrfToken: '{{ csrf_token() }}'
        }
    </script>

    @viteReactRefresh
    @vite(['src/main.jsx'])
</head>
<body class="antialiased">
    <div id="root"></div>
</body>
</html>