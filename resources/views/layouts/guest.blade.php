<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MyFlorist') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- WRAPPER FORM LOGIN / REGISTER -->
    <div class="min-h-screen flex items-center justify-center p-6">
        @yield('content')
    </div>

</body>
</html>
