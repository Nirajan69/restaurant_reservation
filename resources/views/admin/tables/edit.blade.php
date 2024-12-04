@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Table</h1>

    <form action="{{ route('admin.tables.update', $table->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Table Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $table->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Number of Members</label>
            <input type="number" name="members" class="form-control" value="{{ old('members', $table->members) }}" required>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $table->location) }}" required>
        </div>

        <div class="mb-3">
            <label>Location Image</label>
            <input type="file" name="location_image" class="form-control">
            @if($table->location_image)
                <div class="mt-2">
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $table->location_image) }}" alt="Table Location" class="img-thumbnail" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label>Features (Optional)</label>
            <textarea name="features" class="form-control">{{ old('features', $table->features) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Table</button>
    </form>
</div>
@endsection
