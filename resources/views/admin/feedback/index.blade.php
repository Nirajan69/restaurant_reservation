@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Customer Feedback & Menu Ratings</h1>

    <!-- Restaurant Feedback Table -->
    <h4>Restaurant Feedback</h4>
    @if($restaurantFeedback->isEmpty())
        <p class="text-muted">No feedback found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Feedback</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restaurantFeedback as $feedback)
                <tr>
                    <td>{{ $feedback->customer_name }}</td>
                    <td>{{ $feedback->feedback }}</td>
                    <td>{{ $feedback->rating }} / 5</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Menu Ratings Table -->
    <h4 class="mt-5">Menu Ratings</h4>
    @if($menuRatings->isEmpty())
        <p class="text-muted">No menu ratings found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu Item</th>
                    <th>Customer Name</th>
                    <th>Feedback</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuRatings as $rating)
                <tr>
                    <td>{{ $rating->menu->name }}</td>
                    <td>{{ $rating->reservation->name }}</td>
                    <td>{{ $rating->feedback }}</td>
                    <td>{{ $rating->rating }} / 5</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
