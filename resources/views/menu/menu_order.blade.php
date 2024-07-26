@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu1') }}"><img src="image/back-to.svg" alt="">Kembali ke Menu layanan</a>
        <div class="data-order mt-5 mb-2">
            {{-- Layanan dipilih --}}
            <h5 class="mt-5">Layanan yang Anda pilih</h5>

            {{-- Pilih Kendaraan --}}
            <h5 class="mt-5">Pilih Kendaraan dari Profil Anda</h5>

            {{-- Atur Jadwal --}}
            <h5 class="mt-5">Atur Jadwal</h5>
            <div class="form-input mt-3 mb-5">
                <div class="form-row">
                    <div class="form-col">
                        <label for="date">Pilih Tanggal<span>*</span></label>
                        <input type="date" class="form-control" id="date" name="date-booking" required>
                        <div class="error-message" id="date-error"></div>
                    </div>
                    <div class="form-col">
                        <label for="time">Pilih Waktu<span>*</span></label>
                        <input type="time" class="form-control" id="time" name="time-booking"
                            placeholder="Pilih Waktu" required>
                        <div class="error-message" id="time-error"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
