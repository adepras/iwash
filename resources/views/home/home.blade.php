@extends('layouts.app')

@section('title', 'iWash | Cuci dan Salon Mobil Profesional')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <div class="container-home py-5">
        <div class="top-content">
            <div class="tagline">
                <h4>Cuci dan Salon Mobil Profesional</h4>
                <p>Tidak perlu menunggu lama lagi saat ingin mencuci kendaraan Anda<br>Dan kami siap membersihkan kendaraan
                    Anda kapanpun dibutuhkan.</p>
                <button class="btn-learn" onclick="window.location.href='{{ route('register') }}'">Daftar Sekarang</button>
            </div>
            <div class="image-container">
                <img src="image/car-wash-ill.png" alt="" class="half-size">
            </div>
        </div>
    </div>
    <div class="container-layanan py-5">
        <h2 class="mb-4 mt-5">Kami siap merawat mobil Anda</h2>
        <p>Banyak orang sudah menggunakan layanan kami. <br>Apa yang kami tawarkan?</p>
        <img src="image/car-ill.png" alt="" id="car-ill">
        <ul class="text-service mt-5">
            <li><img src="image/fast-time-ill.png" alt="">Proses Cepat</li>
            <li><img src="image/calendar-check-ill.png" alt="">Bebas Atur Jadwal</li>
            <li><img src="image/shield-check-ill.png" alt="">Kendaraan Aman Terjaga</li>
            <li><img src="image/group-ill.png" alt="">Profesional dan Tanggap</li>
            <li><img src="image/drips-ill.png" alt="">Sabun/Foam Premium</li>
            <li><img src="image/verify-ill.png" alt="">Garansi Cuci Kembali</li>
        </ul>
    </div>
    <div class="container-testimoni py-5">
        <div class="testimoni-title">
            <h3>Kata mereka yang telah<br>menggunakan iWash</h3>
        </div>
        <div class="slider">
            @foreach ($testimoni as $testimoniItem)
                <div class="slide">
                    <div class="testimoni-item">
                        <p>{{ $testimoniItem->quote }}</p>
                        <span class="name">{{ $testimoniItem->name }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 1500,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection
