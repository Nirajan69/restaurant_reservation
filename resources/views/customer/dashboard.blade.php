<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex items-center">
            <!-- Centered Title -->
            <div class="flex-1 text-center">
                <h1 class="text-3xl font-bold">Restaurant Reservation System</h1>
            </div>

            <!-- Logout and Buttons Section -->
            <div class="flex flex-col items-end">
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="inline-block mb-2">
                    @csrf
                    <button type="submit" class="bg-gray-700 px-6 py-2 rounded hover:bg-gray-800 text-white">
                        Logout
                    </button>
                </form>

                <!-- Menu and Make Reservation Buttons -->
                <div class="space-y-2">
                    <button id="menu" class="bg-green-600 px-6 py-2 rounded hover:bg-green-700 text-white">
                        Menu
                    </button>
                    <button id="reservation" class="bg-green-600 px-6 py-2 rounded hover:bg-green-700 text-white">
                        Make Reservation
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Dynamic Content -->
    <main class="container mx-auto py-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        {{-- <p>&copy; {{ date('Y') }} Restaurant Reservation. All rights reserved.</p> --}}
    </footer>

    <script>
        $(document).ready(function () {
            $('#menu').on('click', function (e) {
                e.preventDefault();
                window.location.href = "{{ route('customer.menu') }}";
            });

            $('#reservation').on('click', function (e) {
                e.preventDefault();
                window.location.href = "{{ route('customer.reservation.stepOne') }}";
            });
        });
    </script>

</body>
</html>
