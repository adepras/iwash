@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu1') }}"><img src="image/back-to.svg" alt="">Kembali ke Menu layanan</a>
        <div class="data-order mt-5 mb-2">
            {{-- Pilih Kendaraan --}}
            <h5 class="mt-5">Pilih Kendaraan dari Profil Anda</h5>
            <div class="vehicle-list">
                {{-- @if ($vehicles)
                    @foreach ($vehicles as $vehicle)
                        <div class="vehicle-item" data-id="{{ $vehicle->id }}">
                            <p>{{ $vehicle->vehicle_brand }}</p>
                            <p>{{ $vehicle->vehicle_type }}</p>
                            <p>{{ $vehicle->license_plate }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No vehicles found.</p>
                @endif --}}
            </div>

        </div>
    </div>
@endsection
