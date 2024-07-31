@extends('admin.layouts.admin-app')

@section('title', 'Admin | Data Pemesanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container">
        <h1>Today's Bookings</h1>
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
