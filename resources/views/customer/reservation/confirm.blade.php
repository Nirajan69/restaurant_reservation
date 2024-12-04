@extends('customer.dashboard')

@section('content')
<!-- Custom Styles -->
<style>
    /* Global Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5;
        color: #333;
    }

    .reservation-details-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        text-align: left; /* Align content to the left inside the container */
    }

    .reservation-details-container h5 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #555;
    }

    .reservation-details-container ul {
        margin-left: 20px;
        list-style-type: none;
    }

    .reservation-details-container li {
        font-size: 1rem;
        color: #333;
    }

    .btn-success {
        background-color: #38a169;
        border-color: #38a169;
        padding: 12px 20px;
        font-size: 1.1rem;
        font-weight: 600;
        width: 100%;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #2f8b55;
        border-color: #2f8b55;
    }

    /* Custom margin for the button */
    .btn-back {
        margin-top: 1cm; /* Add this line to move the button 1cm down */
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .reservation-details-container {
            padding: 20px;
        }

        .reservation-details-container h5 {
            font-size: 1rem;
        }

        .btn-success {
            font-size: 1rem;
        }
    }
</style>

<!-- Main Content Section -->
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-lg reservation-details-container">
        <div class="card-body">
            <!-- Reservation Details -->
            <h5 class="mb-3 text-dark"><strong>Reservation Details:</strong></h5>
            <ul class="list-unstyled text-left">
                <li><strong>Name:</strong> {{ $feedback->reservation->name }}</li>
                <li><strong>Email:</strong> {{ $feedback->reservation->email }}</li>
                <li><strong>Phone:</strong> {{ $feedback->reservation->phone }}</li>
            </ul>

            <!-- Feedback Details -->
            <h5 class="mb-3 text-dark"><strong>Feedback Details:</strong></h5>
            <ul class="list-unstyled text-left">
                <li><strong>Restaurant Rating:</strong> {{ $feedback->restaurant_rating }}</li>
                <li><strong>Feedback:</strong> {{ $feedback->restaurant_feedback }}</li>
                <li><strong>Menu Ratings:</strong>
                    <ul>
                        @if(!empty($feedback->menu_ratings) && is_array(json_decode($feedback->menu_ratings, true)))
                            @foreach(json_decode($feedback->menu_ratings, true) as $menuId => $rating)
                                <li>Menu ID {{ $menuId }}: {{ $rating }}</li>
                            @endforeach
                        @else
                            <li>No menu ratings provided.</li>
                        @endif
                    </ul>
                </li>
            </ul>

            <!-- Back to Dashboard Button with additional margin -->
            <a href="{{ route('customer.dashboard') }}" class="btn btn-success btn-lg btn-back">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

@endsection
