@extends('customer.dashboard')

@section('content')

<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Custom Styles -->
<style>
    /* Global Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f7fc;
        color: #333;
    }

    .reservation-form-container {
        max-width: 700px;
        margin: 30px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .reservation-form-container h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4CAF50;
        margin-bottom: 30px;
        text-align: center;
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
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    }

    label {
        font-weight: bold;
        color: #555;
        font-size: 1.1rem;
    }

    .btn-success {
        background-color: #4CAF50;
        border-color: #4CAF50;
        padding: 12px 20px;
        font-size: 1.2rem;
        font-weight: 600;
        width: 100%;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    .form-group small {
        font-size: 0.875rem;
        color: #e53e3e;
    }

    .text-center {
        margin-top: 20px;
    }

    /* Error Message Styling */
    .error-message {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 5px;
    }
</style>

<div class="reservation-form-container">
    <h1>Make a Reservation</h1>

    <form action="{{ route('customer.reservations.store.step.one') }}" method="POST">
        @csrf

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name') <small class="error-message">{{ $message }}</small> @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error('email') <small class="error-message">{{ $message }}</small> @enderror
        </div>

        <!-- Phone Field -->
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone') <small class="error-message">{{ $message }}</small> @enderror
        </div>

        <!-- Date Field -->
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
            @error('date') <small class="error-message">{{ $message }}</small> @enderror
        </div>

        <!-- Time Field -->
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ old('time') }}">
            @error('time') <small class="error-message">{{ $message }}</small> @enderror
        </div>

        <!-- Number of Guests Field -->
        <div class="form-group">
            <label for="guests">Number of Guests</label>
            <input type="number" name="guests" id="guests" class="form-control" value="{{ old('guests') }}">
            @error('guests') <small class="error-message">{{ $message }}</small> @enderror
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-success">Next</button>
        </div>
    </form>
</div>

@endsection
