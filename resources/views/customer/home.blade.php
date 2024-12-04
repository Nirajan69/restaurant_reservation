@extends("customer.dashboard") <!-- Extend the main layout -->

@section('title', 'Home') <!-- Set the page title -->

@section('content')

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
            <img src="{{ asset('images/chef1.jpg') }}" alt="Chef John" class="rounded-lg shadow-md">
            <h3 class="mt-4 font-bold text-lg">Chef John Doe</h3>
            <p class="text-gray-600">Specialist in Italian cuisine with over 15 years of experience.</p>
        </div>
        <div class="w-64 mx-4 text-center">
            <img src="{{ asset('images/chef2.jpg') }}" alt="Chef Jane" class="rounded-lg shadow-md">
            <h3 class="mt-4 font-bold text-lg">Chef Jane Smith</h3>
            <p class="text-gray-600">Expert in Asian fusion and a lover of creative flavors.</p>
        </div>
        <div class="w-64 mx-4 text-center">
            <img src="{{ asset('images/chef3.jpg') }}" alt="Chef Alex" class="rounded-lg shadow-md">
            <h3 class="mt-4 font-bold text-lg">Chef Alex Johnson</h3>
            <p class="text-gray-600">Pastry chef renowned for delightful desserts and cakes.</p>
        </div>
    </div>
</section>

<!-- Our Gallery Section -->
<section class="container mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-center mb-6">Our Gallery</h2>
    <div class="flex justify-center gap-4 flex-wrap">
        <!-- Adjusting the parent div for horizontal alignment -->
        <div class="gallery-item">
            <img src="{{ asset('images/dish1.jpg') }}" alt="Grilled Salmon" class="h-40 w-40 object-cover rounded-lg shadow-md">
            <p class="text-center mt-2 text-gray-600">Grilled Salmon with Lemon Butter</p>
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/dish2.jpg') }}" alt="Pasta" class="h-40 w-40 object-cover rounded-lg shadow-md">
            <p class="text-center mt-2 text-gray-600">Creamy Alfredo Pasta</p>
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/dish3.jpg') }}" alt="Dessert" class="h-40 w-40 object-cover rounded-lg shadow-md">
            <p class="text-center mt-2 text-gray-600">Decadent Chocolate Cake</p>
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/dish4.jpg') }}" alt="Cocktail" class="h-40 w-40 object-cover rounded-lg shadow-md">
            <p class="text-center mt-2 text-gray-600">Signature Cocktail</p>
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/dish5.jpg') }}" alt="Pizza" class="h-40 w-40 object-cover rounded-lg shadow-md">
            <p class="text-center mt-2 text-gray-600">Wood-Fired Pizza</p>
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
            <img src="{{ asset('images/restaurant-interior.jpg') }}" alt="Restaurant Interior" class="rounded-lg shadow-md">
        </div>
    </div>
    <div class="text-center mt-6">
        <h3 class="text-xl font-bold">Contact Us:</h3>
        <p class="text-gray-600">Phone: <a href="tel:+1234567890" class="text-blue-600 underline">+1 234 567 890</a></p>
        <p class="text-gray-600">Email: <a href="mailto:info@restaurant.com" class="text-blue-600 underline">info@restaurant.com</a></p>
    </div>
</section>

@endsection
