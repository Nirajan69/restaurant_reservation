@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1>Edit Menu Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menus.update', ['id' => $menu->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Menu Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name) }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $menu->price) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $menu->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients</label>
            <textarea name="ingredients" class="form-control">{{ old('ingredients', $menu->ingredients) }}</textarea>
        </div>

        <div class="form-group">
            <label for="is_veg">Is Vegetarian</label>
            <select name="is_veg" class="form-control" required>
                <option value="1" {{ old('is_veg', $menu->is_veg) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_veg', $menu->is_veg) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($menu->image)
                <img src="{{ asset('uploads/menus/' . $menu->image) }}" alt="{{ $menu->name }}" width="80" height="80">
            @endif
        </div>

        <!-- Manually Add or Edit Ratings -->
        <div class="form-group">
            <label for="manual_rating">Rating (1-5)</label>
            <input type="number" name="manual_rating" class="form-control" min="1" max="5" value="{{ old('manual_rating', $menu->manual_rating) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Menu</button>
    </form>
</div>
@endsection
