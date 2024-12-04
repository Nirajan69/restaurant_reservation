<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hero-banner {
            background-image: url('/images/restaurant-banner.jpg'); /* Replace with a high-quality image */
            background-size: cover;
            background-position: center;
            height: 450px;
            position: relative;
            color: white;
        }
        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .hero-text {
            position: relative;
            z-index: 1;
        }
        .scrollable-gallery {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 10px;
        }
        .scrollable-gallery div {
            display: inline-block;
            margin-right: 10px;
        }
        .scrollable-gallery img {
            width: 300px;
            height: 200px;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 text-white">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Centered Title -->
            <div class="flex-1 text-center">
                <h1 class="text-4xl font-bold">Restaurant Reservation System</h1>
            </div>

            <!-- Auth Links -->
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-white">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-700">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>


    <!-- Hero Section -->
    <section class="hero-banner flex items-center justify-center">
        <div class="hero-text text-center">
            <h1 class="text-4xl font-bold">Welcome to Our Restaurant</h1>
            <p class="text-lg mt-2">Exceptional dining experiences, just a click away.</p>
        </div>
    </section>


    <!-- Our Chefs Section -->
    <section class="container mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-center mb-6">Our Chefs</h2>
        <div class="flex flex-wrap justify-center">
            <div class="w-64 mx-4 text-center">
                <img src="/images/chef1.jpg" alt="Chef John" class="rounded-lg shadow-md">
                <h3 class="mt-4 font-bold text-lg">Chef John Doe</h3>
                <p class="text-gray-600">Specialist in Italian cuisine with over 15 years of experience.</p>
            </div>
            <div class="w-64 mx-4 text-center">
                <img src="/images/chef2.jpg" alt="Chef Jane" class="rounded-lg shadow-md">
                <h3 class="mt-4 font-bold text-lg">Chef Jane Smith</h3>
                <p class="text-gray-600">Expert in Asian fusion and a lover of creative flavors.</p>
            </div>
            <div class="w-64 mx-4 text-center">
                <img src="/images/chef3.jpg" alt="Chef Alex" class="rounded-lg shadow-md">
                <h3 class="mt-4 font-bold text-lg">Chef Alex Johnson</h3>
                <p class="text-gray-600">Pastry chef renowned for delightful desserts and cakes.</p>
            </div>
        </div>
    </section>

    <!-- Our Gallery Section -->
    <section class="container mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-center mb-6">Our Gallery</h2>
        <div class="scrollable-gallery">
            <div>
                <img src="/images/dish1.jpg" alt="Grilled Salmon">
                <p class="text-center mt-2 text-gray-600">Grilled Salmon with Lemon Butter</p>
            </div>
            <div>
                <img src="/images/dish2.jpg" alt="Pasta">
                <p class="text-center mt-2 text-gray-600">Creamy Alfredo Pasta</p>
            </div>
            <div>
                <img src="/images/dish3.jpg" alt="Dessert">
                <p class="text-center mt-2 text-gray-600">Decadent Chocolate Cake</p>
            </div>
            <div>
                <img src="/images/dish4.jpg" alt="Cocktail">
                <p class="text-center mt-2 text-gray-600">Signature Cocktail</p>
            </div>
            <div>
                <img src="/images/dish5.jpg" alt="Pizza">
                <p class="text-center mt-2 text-gray-600">Wood-Fired Pizza </p>
            </div>
        </div>
        </div>

    </section>

  <!-- About Us Section -->
  <section class="container mx-auto px-4 py-10 bg-gray-200 rounded-lg">
    <h2 class="text-3xl font-bold text-center mb-6">About Us</h2>
    <div class="flex flex-wrap items-center">
        <div class="w-full md:w-1/2 px-4">
            <p class="text-lg text-gray-600 mb-4">
                Established in 2005, our restaurant has become a local favorite for offering a wide variety of cuisines prepared with the finest ingredients. From gourmet meals to a friendly ambiance, we aim to create memorable dining experiences for every guest.
            </p>
            <h3 class="text-xl font-bold mb-2">Our Features:</h3>
            <ul class="list-disc pl-5 text-gray-600">
                <li>Online reservation system for your convenience</li>
                <li>Personalized menu recommendations</li>
                <li>Cozy and elegant dining spaces</li>
                <li>Live tracking of table availability</li>
                <li>Customer feedback-driven enhancements</li>
            </ul>
        </div>
        <div class="w-full md:w-1/2 px-4">
            <img src="/images/restaurant-interior.jpg" alt="Restaurant Interior" class="rounded-lg shadow-md">
        </div>
    </div>
    <div class="text-center mt-6">
        <h3 class="text-xl font-bold">Contact Us:</h3>
        <p class="text-gray-600">Phone: <a href="tel:+1234567890" class="text-blue-600 underline">+1 234 567 890</a></p>
        <p class="text-gray-600">Email: <a href="mailto:info@restaurant.com" class="text-blue-600 underline">info@restaurant.com</a></p>
    </div>
</section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        {{-- <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Restaurant Reservation. All Rights Reserved.</p>
            <p>Follow us on <a href="#" class="underline text-blue-400">Facebook</a>, <a href="#" class="underline text-blue-400">Twitter</a>, <a href="#" class="underline text-blue-400">Instagram</a>.</p>
        </div> --}}
    </footer>

</body>
</html>
