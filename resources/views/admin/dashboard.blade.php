{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('admin.users.index') }}" class="text-white">{{ $userCount }}</a>
                    </h5>
                    <p class="card-text">Total number of registered users.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Today's Bookings</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('admin.bookings.today') }}" class="text-white">{{ $todayBookingsCount }}</a>
                    </h5>
                    <p class="card-text">Number of bookings made today.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
