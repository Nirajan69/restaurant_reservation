@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Reservations List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <p class="text-center text-muted">No reservations found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    {{-- <th>Phone</th> --}}
                    <th>Date</th>
                    <th>Time</th>
                    <th>Guests</th>
                    <th>Menu</th>
                    <th>Table</th> <!-- Added Column for Table -->
                    <th>Actions</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->email }}</td>
                    {{-- <td>{{ $reservation->phone }}</td> --}}
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>{{ $reservation->guests }}</td>
                    <td>
                        @php
                            $reservedMenuIds = json_decode($reservation->reserved_menu);
                            if (!is_array($reservedMenuIds)) {
                                $reservedMenuIds = [];
                            }
                            $menuNames = \App\Models\Menu::whereIn('id', $reservedMenuIds)->pluck('name')->toArray();
                        @endphp
                        @if(count($menuNames) > 0)
                            {{ implode(', ', $menuNames) }}
                        @else
                            No menu selected
                        @endif
                    </td>
                    <td>
                        @if($reservation->table)
                            {{ $reservation->table->table_name }} <!-- Displaying selected table -->
                        @else
                            No table selected
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                    <td>
                        @if($reservation->feedback)  <!-- Check if feedback exists -->
                            {{ $reservation->feedback }}  <!-- Display the feedback -->
                        @else
                            No feedback provided
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<style>
    .table-bordered tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
    .table-bordered tbody tr:hover {
        background-color: #f1f1f1;
    }
    .card-header {
        border-bottom: 2px solid #0056b3;
    }
</style>
@endsection
