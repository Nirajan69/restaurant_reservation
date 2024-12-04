@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1>Edit Feedback for Reservation #{{ $reservation->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="feedback">Feedback</label>
            <textarea name="feedback" class="form-control" rows="5">{{ old('feedback', $reservation->feedback) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Feedback</button>
    </form>

    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary mt-3">Back to Reservations</a>
</div>
@endsection
