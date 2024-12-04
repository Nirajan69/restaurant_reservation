<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <h1>Restaurant Reservation System</h1>
    </header>
    <main class="py-4">
        @yield('content')
    </main>
    <footer class="bg-dark text-white text-center py-3">
        {{-- <p>&copy; 2024 Restaurant Reservation System</p> --}}
    </footer>
</body>
</html>
