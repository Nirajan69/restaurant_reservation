@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Table</h1>

    <form action="{{ route('admin.tables.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Table Name</label>
            <input type="text" name="table_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Number of Members</label>
            <input type="number" name="members" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Location Image</label>
            <input type="file" name="location_image" class="form-control">
        </div>
        <div class="mb-3">
            <label>Features (Optional)</label>
            <textarea name="features" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Table</button>
    </form>
</div>
@endsection
