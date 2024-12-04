{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Add your styles -->
</head>
<body>

    <div class="container">
        <h1>Our Menu</h1>
        <p>Here is the list of dishes available:</p>

        <!-- Example menu items -->
        <ul>
            <li>Dish 1 - $10</li>
            <li>Dish 2 - $15</li>
            <li>Dish 3 - $20</li>
        </ul>

        <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>

</body>
</html> --}}


@extends('customer.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Our Menu</h1>
    <div class="row">
        @foreach($menus as $menu)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                @else
                <img src="{{ asset('images/default-menu.jpg') }}" class="card-img-top" alt="Default Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $menu->name }}</h5>
                    <p class="card-text">{{ $menu->description }}</p>
                    <p class="card-text"><strong>Ingredients:</strong> {{ $menu->ingredients }}</p>
                    <p class="card-text"><strong>Price:</strong> Rs. {{ $menu->price }}</p>
                    <p class="card-text"><strong>Type:</strong> {{ $menu->is_veg ? 'Vegetarian' : 'Non-Vegetarian' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

