@extends('layouts.app')

@section('title', 'iWash | Detailing Mobil')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/pack.css') }}">

    <div class="container-package py-5">
        <h2 class="mb-4 mt-5">Pilihan Paket Lengkap dan Kualitas Terjamin <br>Ayo Cuci Mobil Anda Sekarang!</h2>
        <p>Pilihan paket dan harga yang bervariasi sesuai kebutuhanmu.</p>
        <div class="card-container">
            <div class="card">
                <div class="card-title">
                    <img src="image/cuci-mobil-ill.png" alt="">
                    <h5>Cuci Mobil</h5>
                    <a href="">Lihat detail</a>
                </div>
            </div>
            <div class="card">
                <div class="card-title">
                    <img src="image/interior-ill.png" alt="">
                    <h5>Detailing Interior</h5>
                    <a href="">Lihat detail</a>
                </div>
            </div>
            <div class="card">
                <div class="card-title">
                    <img src="image/eksterior-ill.png" alt="">
                    <h5>Detailing Eksterior</h5>
                    <a href="">Lihat detail</a>
                </div>
            </div>
            <div class="card">
                <div class="card-title">
                    <img src="image/kaca-ill.png" alt="">
                    <h5>Detailing Kaca</h5>
                    <a href="">Lihat detail</a>
                </div>
            </div>
            <div class="card">
                <div class="card-title">
                    <img src="image/mesin-ill.png" alt="">
                    <h5>Detailing Mesin</h5>
                    <a href="">Lihat detail</a>
                </div>
            </div>
            <div class="card">
                <div class="card-title">
                    <img src="image/ban-velg-ill.png" alt="">
                    <h5>Detailing Ban & Velg</h5>
                    <a href="">Lihat detail</a>
                </div>
            </div>
        </div>
    </div>

@endsection
