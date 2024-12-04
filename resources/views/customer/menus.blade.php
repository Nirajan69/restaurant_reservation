@extends('customer.dashboard') <!-- Assuming a layout file -->

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">

    <!-- Search Bar -->
    <form action="{{ route('customer.menus.search') }}" method="GET" style="margin-bottom: 30px; display: flex; justify-content: center; gap: 10px;">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search menus by name or description..."
            style="padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 5px;"
        >
        <button type="submit" style="padding: 10px 20px; background-color: #38a169; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Search
        </button>
    </form>

    <!-- Display Available Menus -->
    <h2 style="font-size: 2rem; font-weight: bold; text-align: center; color: #e53e3e; margin-bottom: 40px;">
        Available Menus
    </h2>

    @if($menus->isEmpty())
        <p style="text-align: center;">No menu items found for your search.</p>
    @else
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            @foreach($menus as $menu)
                <div style="border: 1px solid #ddd; padding: 20px; width: 300px; text-align: center; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <img
                        src="{{ asset('uploads/menus/' . $menu->image) }}"
                        alt="{{ $menu->name }}"
                        style="width: 100%; height: 200px; object-fit: cover; margin-bottom: 10px; border-radius: 10px;"
                    >
                    <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 10px;">{{ $menu->name }}</h3>
                    <p style="margin-bottom: 10px;">{{ $menu->description }}</p>
                    <p style="font-weight: bold; color: #e53e3e; margin-bottom: 10px;">Price: Rs. {{ $menu->price }}</p>
                    <p style="color: #38a169; font-weight: bold; margin-bottom: 10px;">Rating: {{ $menu->manual_rating ?? 'No Rating' }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
