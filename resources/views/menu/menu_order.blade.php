@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ url()->previous() }}">
            <img src="image/back-to.svg" alt="">Kembali ke Menu layanan
        </a>
        <div class="data-order mt-5 mb-2">
            {{-- Layanan dipilih --}}
            <h5 class="mt-5">Layanan yang Anda pilih</h5>

            {{-- Pilih Kendaraan --}}
            <h5 class="mt-5">Pilih Kendaraan dari Profil Anda</h5>

            {{-- Atur Jadwal --}}
            <h5 class="mt-5">Atur Jadwal</h5>

        </div>
    </div>
@endsection
