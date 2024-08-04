@extends('admin.layouts.admin-app')

@section('title', 'Admin | Data Kendaraan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container">
        <h3>Daftar Kendaraan</h3>
        <div class="container-tools mb-2">
            {{-- Refresh --}}
            <a href="{{ route('admin.menu.vehicles') }}" class="btn-refresh"><img src="/image/arrow-clockwise.svg"
                    alt=""></a>
            {{-- Pencarian --}}
            <form action="{{ route('admin.menu.vehicles') }}" method="GET" class="d-inline-block">
                <input type="text" name="search" class="form-control" placeholder="Cari..."
                    value="{{ request('search') }}">
            </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a
                            href="{{ route('admin.menu.vehicles', ['sortBy' => 'vehicle_brand', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Brand
                            @if ($sortBy === 'vehicle_brand')
                                @if ($sortOrder === 'asc')
                                    <img src="/image/arrow-up.svg" alt="">
                                @else
                                    <img src="/image/arrow-down.svg" alt="">
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a
                            href="{{ route('admin.menu.vehicles', ['sortBy' => 'vehicle_type', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Tipe
                            @if ($sortBy === 'vehicle_type')
                                @if ($sortOrder === 'asc')
                                    <img src="/image/arrow-up.svg" alt="">
                                @else
                                    <img src="/image/arrow-down.svg" alt="">
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a
                            href="{{ route('admin.menu.vehicles', ['sortBy' => 'license_plate', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Nomor Polisi
                            @if ($sortBy === 'license_plate')
                                @if ($sortOrder === 'asc')
                                    <img src="/image/arrow-up.svg" alt="">
                                @else
                                    <img src="/image/arrow-down.svg" alt="">
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a
                            href="{{ route('admin.menu.vehicles', ['sortBy' => 'name', 'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Nama Pemilik
                            @if ($sortBy === 'name')
                                @if ($sortOrder === 'asc')
                                    <img src="/image/arrow-up.svg" alt="">
                                @else
                                    <img src="/image/arrow-down.svg" alt="">
                                @endif
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $index => $vehicle)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $vehicle->vehicle_brand }}</td>
                        <td>{{ $vehicle->vehicle_type }}</td>
                        <td>{{ $vehicle->license_plate }}</td>
                        <td>{{ $vehicle->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
