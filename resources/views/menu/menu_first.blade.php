@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="image/back-to.svg" alt="">Kembali ke jenis layanan</a>
        <form id="booking-form" action="{{ route('booking.store') }}" method="post">
            @csrf
            <input type="hidden" name="service" id="selected-service" value="Perawatan Satu Kali Cuci">
            <input type="hidden" name="package" id="selected-package" value="">
            <input type="hidden" name="price" id="selected-price" value="">
            <input type="hidden" name="estimated" id="selected-time" value="">
            <input type="hidden" name="date_booking" id="selected-date" value="">
            <input type="hidden" name="vehicle_brand" id="selected-vehicle-brand" value="">
            <input type="hidden" name="vehicle_type" id="selected-vehicle-type" value="">
            <input type="hidden" name="license_plate" id="selected-license-plate" value="">

            <div class="category-menu mt-5 mb-2">
                {{-- Satu Kali Cuci --}}
                <h5>Pilih Paket Satu Kali Cuci</h5>
                <div class="price-menu">
                    <div class="card-price selectable" data-package="Basic" data-price="50000" data-time="60">
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
                                jam</p>
                        </div>
                    </div>
                    <div class="card-price selectable" data-package="Standard" data-price="60000" data-time="120">
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
                                jam</p>
                        </div>
                    </div>
                    <div class="card-price selectable" data-package="Professional" data-price="70000" data-time="180">
                        <h5><img src="image/p-professional.png" alt="">Professional</h5>
                        <ul class="card-service">
                            <li style="font-weight: 600"><img src="image/check-ill.png" alt="">All in Standard</li>
                            <li><img src="image/check-ill.png" alt="">Spot Remover</li>
                            <li style="margin-left: 26px">(Window)</li>
                            <li><img src="image/check-ill.png" alt="">Tar Remover</li>
                        </ul>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp70.000</h6>
                            <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg"
                                    alt="">Estimasi 3
                                jam</p>
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
                            <div class="vehicle-item selectable" data-id="{{ $vehicle->id }}"
                                data-brand="{{ $vehicle->vehicle_brand }}" data-type="{{ $vehicle->vehicle_type }}"
                                data-plate="{{ $vehicle->license_plate }}">
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
                                <input type="date" class="form-control booking-date" id="date"
                                    name="date_booking" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tombol Reset dan Pesan Sekarang --}}
            <div class="order-menu mt-5">
                <button type="button" class="btn-reset">Reset</button>
                <button type="submit" class="btn-next">Pesan Sekarang</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.card-price').click(function() {
                $('.card-price').removeClass('selected');
                $(this).addClass('selected');
                $('#selected-package').val($(this).data('package'));
                $('#selected-price').val($(this).data('price'));
                $('#selected-time').val($(this).data('time'));
            });

            $('.vehicle-item').click(function() {
                $('.vehicle-item').removeClass('selected');
                $(this).addClass('selected');
                $('#selected-vehicle-brand').val($(this).data('brand'));
                $('#selected-vehicle-type').val($(this).data('type'));
                $('#selected-license-plate').val($(this).data('plate'));
            });

            $('.btn-reset').click(function() {
                $('.card-price, .vehicle-item').removeClass('selected');
                $('#selected-package, #selected-price, #selected-time, #selected-vehicle-brand, #selected-vehicle-type, #selected-license-plate')
                    .val('');
                $('#date').val('');
            });
        });
    </script>
@endsection
