@extends('admin.layouts.admin-app')

@section('title', 'Admin | Data Pemesanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container">
        <h3>Data Pemesanan dan Antrian</h3>
        <a href="{{ route('admin.bookings.download') }}" class="btn btn-primary mb-3">Download CSV</a>
        <div class="container-tools mb-2">
            {{-- Refresh --}}
            <a href="{{ route('admin.menu.bookings') }}" class="btn-refresh"><img src="/image/arrow-clockwise.svg"
                    alt=""></a>
            {{-- Pencarian --}}
            <form action="" method="GET" class="d-inline-block">
                <input type="text" name="search" class="form-control" placeholder="Cari..."
                    value="{{ request('search') }}">
            </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Service</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user_id }}</td>
                        <td>{{ $booking->service }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
