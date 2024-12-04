<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 15px;
            position: fixed;
            height: 100%;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        {{-- <a href="/admin/dashboard">Dashboard</a> --}}
        <a href="/admin/menus">Manage Menus</a>

        {{-- <a href="{{ route('admin.menus.index') }}">Manage Menus</a> --}}

        <a href="/admin/reservations">Reservations</a>
        {{-- <a href="/admin/feedback">Feedback</a> --}}
        <a href="/admin/tables">Manage Tables</a>
        {{-- <a href="/logout">Logout</a> --}}

        <a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<!-- Add a hidden logout form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

    </div>
    <div class="content">
        <div class="header">
            <h3>Welcome, Admin</h3>
        </div>
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>
