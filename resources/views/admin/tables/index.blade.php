@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Table List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.tables.create') }}" class="btn btn-primary mb-3">Add New Table</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Table Name</th>
                <th>Members</th>
                <th>Location</th>
                <th>Location Image</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tables as $table)
            <tr>
                <td>{{ $table->table_name }}</td>
                <td>{{ $table->members }}</td>
                <td>{{ $table->location }}</td>
                <td>
                    @if($table->location_image)
                        <img src="{{ asset('storage/' . $table->location_image) }}" alt="{{ $table->table_name }}" width="80">
                    @else
                        <span>No image</span>
                    @endif
                </td>
                <td>{{ $table->availability ? 'Available' : 'Reserved' }}</td>
                <td>
                    <a href="{{ route('admin.tables.edit', $table->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.tables.destroy', $table->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
