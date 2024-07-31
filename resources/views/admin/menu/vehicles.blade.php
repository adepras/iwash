@extends('admin.layouts.admin-app')

@section('title', 'Admin | Data Kendaraan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container">
        <h4>Daftar Kendaraan</h4>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $index => $vehicle)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $vehicle->vehicle_brand }}</td>
                        <td>{{ $vehicle->vehicle_type }}</td>
                        <td>{{ $vehicle->license_plate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
