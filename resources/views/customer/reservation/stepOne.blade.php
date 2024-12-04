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

    .reservation-form-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .reservation-form-container h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #38a169;
        margin-bottom: 30px;
        text-align: center;
    }

    .greeting {
        font-size: 1.8rem;
        font-weight: 500;
        color: #2d3748;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 1.5rem;
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
        font-size: 1.2rem;
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

    .form-group small {
        font-size: 0.875rem;
        color: #e53e3e;
    }

    .text-center {
        margin-top: 20px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .reservation-form-container {
            padding: 20px;
        }

        .reservation-form-container h1 {
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

<div class="reservation-form-container">
    <!-- Greeting Message -->
    <div class="greeting">
        Hello, {{ Auth::user()->name }}!
        <div>
            Make a Reservation
    </div>
    </div>


    <form action="{{ route('customer.reservation.storeStepOne') }}" method="POST">
        @csrf

        <!-- Date Field -->
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <!-- Time Field -->
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" name="time" class="form-control" required>
        </div>

        <!-- Number of Guests Field -->
        <div class="form-group">
            <label for="guests">Number of Guests</label>
            <input type="number" name="guests" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>

@endsection
