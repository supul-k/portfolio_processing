<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include your CSS stylesheets and any other necessary meta tags or scripts here -->

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body>

    @yield('content')

    <footer>
        <!-- Include your footer content here -->
    </footer>

    <!-- Include your JavaScript files or any other scripts here -->
</body>
</html>
