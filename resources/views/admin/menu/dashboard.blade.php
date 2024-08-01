@extends('admin.layouts.admin-app')

@section('title', 'Admin | Dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Pengguna</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('admin.menu.users') }}" class="text-white">{{ $userCount }}</a>
                    </h5>
                    <p class="card-text">Jumlah Total Pengguna.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Pesanan Masuk</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('admin.bookings.today') }}" class="text-white">{{ $todayBookingsCount }}</a>
                    </h5>
                    <p class="card-text">Transaksi Pesanan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
