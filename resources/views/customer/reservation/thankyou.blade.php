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

    .feedback-form-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        text-align: left; /* Align content to the left inside the container */
    }

    .feedback-form-container h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #38a169;
        margin-bottom: 30px;
        text-align: center;
    }

    .feedback-form-container p {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 2rem; /* Increased gap between lines */
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        box-shadow: none;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #38a169;
        box-shadow: 0 0 5px rgba(56, 161, 105, 0.3);
    }

    label {
        font-weight: bold;
        color: #555;
        font-size: 1.1rem;
    }

    .btn-primary {
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

    .btn-primary:hover {
        background-color: #2f8b55;
        border-color: #2f8b55;
    }

    .alert {
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-light {
        background-color: #f9f9f9;
        color: #555;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .feedback-rating-section {
        margin-top: 40px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .feedback-form-container {
            padding: 20px;
        }

        .feedback-form-container h2 {
            font-size: 2rem;
        }

        .form-control {
            font-size: 0.9rem;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }
</style>

<!-- Main Content Section -->
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-lg feedback-form-container">
        <div class="card-body">
            <!-- Thank You Message -->
            <h2 class="text-primary font-weight-bold">Thank You for Your Reservation!</h2>
            <p class="text-secondary mb-4">Your reservation has been successfully created. We look forward to serving you!</p>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Reservation Details -->
            <div class="alert alert-light border p-4 shadow-sm">
                <h5 class="mb-3 text-dark"><strong>Reservation Details:</strong></h5>
                <ul class="list-unstyled text-left mb-0">
                    <li><strong class="text-secondary">Name:</strong> {{ $reservation->name }}</li>
                    <li><strong class="text-secondary">Email:</strong> {{ $reservation->email }}</li>
                    {{-- <li><strong class="text-secondary">Phone:</strong> {{ $reservation->phone }}</li> --}}
                    <li><strong class="text-secondary">Date:</strong> {{ $reservation->date }}</li>
                    <li><strong class="text-secondary">Time:</strong> {{ $reservation->time }}</li>
                    <li><strong class="text-secondary">Guests:</strong> {{ $reservation->guests }}</li>
                    <li><strong class="text-secondary">Table:</strong>
                        {{ $reservation->table ? $reservation->table->table_name : 'No table selected' }}
                    </li>
                </ul>
            </div>

            <!-- Feedback Form -->
            <form action="{{ route('customer.feedback.store') }}" method="POST">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                <!-- Menu Ratings -->
                <div class="feedback-rating-section">
                    <h4 class="text-success mt-4">Rate Your Menus</h4>
                    <ul class="list-unstyled">
                        @foreach($reservation->menus as $menu)
                            <li>
                                <strong class="text-secondary">{{ $menu->name }}</strong>
                                <div class="mb-3">
                                    <label for="rating_{{ $menu->id }}" class="form-label">Rate {{ $menu->name }} (1-5):</label>
                                    <select name="rating_{{ $menu->id }}" id="rating_{{ $menu->id }}" class="form-control" required>
                                        <option value="" disabled selected>Select a rating</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Restaurant Rating -->
                <div class="feedback-rating-section">
                    <h4 class="text-success mt-4">Rate Your Experience</h4>
                    <div class="mb-3">
                        <label for="restaurant_rating" class="form-label">Rate the Restaurant (1-5):</label>
                        <select name="restaurant_rating" id="restaurant_rating" class="form-control" required>
                            <option value="" disabled selected>Select a rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Feedback -->
                <div class="feedback-rating-section">
                    <h4 class="text-success mt-4">We’d love your feedback!</h4>
                    <div class="mb-3">
                        <label for="restaurant_feedback" class="form-label">Your Feedback:</label>
                        <textarea name="restaurant_feedback" id="restaurant_feedback" class="form-control" rows="4" placeholder="Write your feedback here..." required></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    Submit Feedback
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
