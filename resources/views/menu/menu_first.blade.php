@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="image/back-to.svg" alt="">Kembali ke jenis layanan</a>
        <form action="" method="post">
            <div class="category-menu mt-5 mb-2">
                {{-- Satu Kali Cuci --}}
                <h5>Pilih Paket Satu Kali Cuci</h5>
                <div class="price-menu">
                    <div class="card-price" data-basic-price="50000" data-basic-time="Estimasi 1 Jam">
                        <h5><img src="image/p-basic.png" alt="">Basic</h5>
                        <ul class="card-service">
                            <li><img src="image/check-ill.png" alt="">Hand Wash</li>
                            <li><img src="image/check-ill.png" alt="">Interior Cleaning</li>
                            <li><img src="image/check-ill.png" alt="">Vacuum</li>
                            <li><img src="image/check-ill.png" alt="">Tire Polish</li>
                        </ul>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp50.000</h6>
                            <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 1
                                jam
                            </p>
                        </div>
                        <div class="select-price">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="basic"
                                value="basic">
                        </div>
                    </div>
                    <div class="card-price" data-standard-price="60000" data-standard-time="Estimasi 1 Jam">
                        <h5><img src="image/p-standard.png" alt="">Standard</h5>
                        <ul class="card-service">
                            <li style="font-weight: 600"><img src="image/check-ill.png" alt="">All in Basic</li>
                            <li><img src="image/check-ill.png" alt="">Foam Wash</li>
                            <li><img src="image/check-ill.png" alt="">Spot Remover (Body)</li>
                            <li><img src="image/check-ill.png" alt="">Engine Cleaning</li>
                        </ul>
                        <div class="price">
                            <p>Harga</p>
                            <h6 class="service-price">Rp60.000</h6>
                            <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 2
                                jam
                            </p>
                        </div>
                        <div class="select-price">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="standard"
                                value="standard">
                        </div>
                    </div>
                    <div class="card-price" data-professional-price="70000" data-professional-time="Estimasi 1 Jam">
                        <h5><img src="image/p-professional.png" alt="">Professional</h5>
                        <ul class="card-service">
                            <li style="font-weight: 600"><img src="image/check-ill.png" alt="">All in Standard</li>
                            <li><img src="image/check-ill.png" alt="">Spot Remover </li>
                            <li style="margin-left: 26px">(Window)</li>
                            <li><img src="image/check-ill.png" alt="">Tar Remover</li>
                        </ul>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp70.000</h6>
                            <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 3
                                jam
                            </p>
                        </div>
                        <div class="select-price">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="professional"
                                value="professional">
                        </div>
                    </div>
                </div>
            </div>
            <div class="data-order mt-5 mb-2">
                <div class="data-layout">
                    {{-- Pilih Kendaraan --}}
                    <h5 class="mt-5">Pilih Kendaraan dari Profil Anda</h5>
                    <div class="vehicle-list">
                        @foreach ($vehicles as $vehicle)
                            <div class="vehicle-item" data-id="{{ $vehicle->id }}">
                                <p>{{ $vehicle->vehicle_brand }}</p>
                                <p>{{ $vehicle->vehicle_type }}</p>
                                <p>{{ $vehicle->license_plate }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="data-layout">
                    {{-- Atur Jadwal --}}
                    <h5 class="mt-5">Atur Jadwal</h5>
                    <div class="form-input form-date mt-3 mb-5">
                        <div class="form-row">
                            <div class="form-col">
                                <label for="date">Pilih Tanggal<span>*</span></label>
                                <input type="date" class="form-control booking-date" id="date" name="date-booking"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-menu mt-5">
                <button class="btn-reset">Reset</button>
                <button class="btn-next" type="submit">Pesan Sekarang</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
