<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Layanan Akademik FUSPI')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
            color: #172033;
        }

        main {
            max-width: 900px;
            margin: 48px auto;
            padding: 28px;
            background: white;
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <main>
        @yield('content')
    </main>
</body>

</html>