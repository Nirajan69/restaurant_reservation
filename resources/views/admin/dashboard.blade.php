@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/restaurant.jpg') }}" class="card-img-top" alt="Restaurant">
                <div class="card-body">
                    <h5 class="card-title">Welcome to Admin Dashboard</h5>

                    {{-- <h1>Welcome, Admin</h1>
<a href="{{ route('admin.menus.index') }}">Manage Menus</a>
<a href="{{ route('admin.tables.index') }}">Manage Tables</a> --}}

                    <p class="card-text">Manage menus, reservations, and tables efficiently.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
