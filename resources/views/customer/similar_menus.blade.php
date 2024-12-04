@extends('customer.layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">

    <h2 style="font-size: 2rem; font-weight: bold; text-align: center; color: #e53e3e; margin-bottom: 40px;">
        Similar Menus
    </h2>

    @if (empty($similarities))
        <p style="text-align: center;">No similar menus found.</p>
    @else
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            @foreach ($similarities as $similar)
                <div style="border: 1px solid #ddd; padding: 20px; width: 300px; text-align: center;">
                    <h3>{{ $similar['menu']->name }}</h3>
                    <p>{{ $similar['menu']->description }}</p>
                    <p>Price: Rs. {{ $similar['menu']->price }}</p>
                    <p>Similarity Score: {{ number_format($similar['similarity'], 2) }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
