@extends('admin.layouts.admin-app')

@section('title', 'Admin | Data Antrian')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container">
        <h1>Data Antrian</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Outlet ID</th>
                    <th>Date</th>
                    <th>Start Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slots as $slot)
                    <tr>
                        <td>{{ $slot->outlet_id }}</td>
                        <td>{{ $slot->date }}</td>
                        <td>{{ $slot->start_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
