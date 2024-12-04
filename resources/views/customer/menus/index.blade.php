@extends('customer.dashboard') <!-- Extend from customer.dashboard layout -->

@section('content') <!-- Define the content section -->
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">

    <!-- Search Form -->
    <form action="{{ route('customer.menus.search') }}" method="GET" style="display: flex; justify-content: center; margin-bottom: 20px;">
        <input
            type="text"
            name="search"
            placeholder="Search for menus..."
            value="{{ request('search') }}"
            style="padding: 10px; font-size: 16px; width: 300px; border: 1px solid #ddd; border-radius: 5px;"
        >
        <button type="submit" style="padding: 10px 20px; margin-left: 10px; background-color: #38a169; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Search
        </button>
    </form>

    <!-- Display Available Menus -->
    <h2 style="font-size: 2rem; font-weight: bold; text-align: center; color: #e53e3e; margin-bottom: 40px;">
        Available Menus
    </h2>

    @if ($menus->isEmpty())
        <p style="text-align: center;">No menu items available.</p>
    @else
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            @foreach ($menus as $menu)
                <div style="border: 1px solid #ddd; padding: 20px; width: 300px; text-align: center;">
                    <img src="{{ asset('uploads/menus/' . $menu->image) }}" alt="{{ $menu->name }}" style="width: 100%; height: 200px; object-fit: cover; margin-bottom: 10px;">
                    <h3>{{ $menu->name }}</h3>
                    <p>{{ $menu->description }}</p>
                    <p>Price: Rs. {{ $menu->price }}</p>
                    <p style="color: #38a169; font-weight: bold;">Rating: {{ $menu->manual_rating ?? 'No Rating' }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Recommended Menus Section -->
    <h2 class="mt-5" style="font-size: 2rem; font-weight: bold; text-align: center; color: #38a169; margin-bottom: 40px;">
        Recommended Menus
    </h2>
    

</div>
@endsection
