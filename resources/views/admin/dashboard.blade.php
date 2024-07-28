@extends('admin.admin-app')

@section('title', 'Admin | Dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="dashboard-container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">User</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $userCount }}</h5>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Booking</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $todayBookingsCount }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection