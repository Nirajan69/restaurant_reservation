    @extends('admin.layout')

    @section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Menu List</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary mb-3">Add New Menu Item</a>

        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Name</th>
                    <th>Ingredients</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Vegetarian</th>
                    <th>Image</th>
                    <th>Actions</th>
                    <th>Rating</th>


                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>

                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->ingredients }}</td>
                    <td>{{ $menu->description }}</td>
                    <td>${{ number_format($menu->price, 2) }}</td>
                    <td>{{ $menu->is_veg ? 'Yes' : 'No' }}</td>
                    {{-- <td>
                        @if($menu->image) --}}
                            {{-- <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="80" height="80"> --}}
                            {{-- <img src="{{ asset('uploads/images/' . $menu->image) }}" alt="{{ $menu->name }}">

                            @else
                            <span>No image</span>
                        @endif
                    </td> --}}

                    <td>
                        @if($menu->image)
                        <img  src="{{ asset('') }}uploads/menus/{{$menu->image}}" alt="image" height="65px">

                        @else
                        No Image

                        @endif
                        {{-- <img  src="{{ asset('') }}uploads/menus/{{$menu->image}}" alt="image" height="65px"> --}}


                    </td>

                    <td>
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this menu item?');">Delete</button>
                        </form>
                    </td>
                    {{-- <td>{{ is_numeric($menu->average_rating) ? number_format($menu->average_rating, 1) : $menu->average_rating }}</td> --}}
                    <td>{{ $menu->manual_rating ?? 'No Rating' }}</td> <!-- Displaying manual_rating -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
