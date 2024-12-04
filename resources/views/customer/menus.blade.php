@extends('customer.dashboard') <!-- Assuming a layout file -->

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">

    <!-- Search Bar -->
    <form action="{{ route('customer.menus.search') }}" method="GET" style="margin-bottom: 30px; display: flex; justify-content: center; gap: 10px;">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search menus by name or description..."
            style="padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 5px;"
        >
        <button type="submit" style="padding: 10px 20px; background-color: #38a169; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Search
        </button>
    </form>
    <!-- Display Available Menus -->
    <h2 style="font-size: 2rem; font-weight: bold; text-align: center; color: #e53e3e; margin-bottom: 40px;">
        Your recommended Menus
    </h2>

    <div class="container mt-5">
    @if(isset($menus) && count($menus) > 0)
        <div class="row">
            @foreach($menus as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="card-title" style="font-weight:bold; font-size:1.5rem;">{{ $menu['Name'] }}</h2>
                            <p class="card-text">{{ Str::limit($menu['Describe'], 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">{{ $menu['C_Type'] }}</span>
                                <span class="badge" 
      style="background-color: {{ $menu['Veg_Non'] == 'veg' ? 'green' : 'red' }}; 
             color: white; 
             padding: 5px 10px; 
             margin-right: 5px; 
             border-radius: 20px; 
             font-weight: bold;">
                                    {{ ucfirst($menu['Veg_Non']) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        <div class="alert alert-info">
            No results found.
        </div>
    @endif
</div>



</div>
@endsection
