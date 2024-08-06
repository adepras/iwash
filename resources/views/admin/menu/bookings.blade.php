@extends('admin.layouts.admin-app')

@section('title', 'Admin | Data Pemesanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container">
        <h3>Data Pemesanan dan Antrian</h3>
        <a href="{{ route('bookings.downloadCsv') }}" class="btn btn-primary mb-3">Download CSV</a>
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
                    <th>Nama User</th>
                    <th>Layanan</th>
                    <th>Paket</th>
                    <th>Tanggal Booking</th>
                    <th>Waktu Booking</th>
                    <th>Status</th>
                    <th>Alasan</th>
                    <th>Waktu Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->service }}</td>
                        <td>{{ $booking->package }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->time_booking }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->reason }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td><button>Detail</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
