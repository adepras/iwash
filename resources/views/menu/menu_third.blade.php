@extends('layouts.app')

@section('title', 'iWash | Paket Super')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="image/back-to.svg" alt="">Kembali ke jenis layanan</a>
        <div class="category-menu mt-5 mb-2" id="menu3">
            <h5>Pilih Paket Super</h5>
            <p class="mt-4">Ukuran mobil Anda</p>

            <a href="">Cari tahu ukuran mobil Anda <img src="image/arrow-right.svg" alt=""></a>
            <div class="price-menu">

            </div>
        </div>
        <div class="price-menu">
            <div class="order-menu mt-5">
                <button class="btn-reset">Reset</button>
                <button class="btn-next">Lanjutkan</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
