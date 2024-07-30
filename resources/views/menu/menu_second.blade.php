@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="image/back-to.svg" alt="">Kembali ke jenis layanan</a>
        <form id="booking-form" action="{{ route('booking.store') }}" method="post">
            @csrf
            <input type="hidden" name="service" id="selected-service" value="Perawatan Salon Mobil / Detailing">
            <input type="hidden" name="package" id="selected-package" value="">
            <input type="hidden" name="price" id="selected-price" value="">
            <input type="hidden" name="estimated" id="selected-time" value="">
            <input type="hidden" name="date_booking" id="selected-date" value="">
            <input type="hidden" name="vehicle_brand" id="selected-vehicle-brand" value="">
            <input type="hidden" name="vehicle_type" id="selected-vehicle-type" value="">
            <input type="hidden" name="license_plate" id="selected-license-plate" value="">

            <div class="category-menu mt-5 mb-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- Salon Mobil / Detailing --}}
                <h5>Pilih Paket Salon Mobil / Detailing</h5>
                <div class="price-menu">
                    <div class="card-price selectable" data-package="Detailing Interior" data-price="50000" data-time="60">
                        <h5>Detailing Interior</h5>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp50.000</h6>
                            <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi 1 jam</p>
                        </div>
                    </div>
                    <div class="card-price selectable" data-package="Detailing Ekterior" data-price="60000" data-time="60">
                        <h5>Detailing Eksterior</h5>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp60.000</h6>
                            <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi 1 jam</p>
                        </div>
                    </div>
                    <div class="card-price selectable" data-package="Detailing Kaca Mobil" data-price="40000"
                        data-time="30">
                        <h5>Detailing Kaca Mobil</h5>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp40.000</h6>
                            <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi 1 jam</p>
                        </div>
                    </div>
                    <div class="card-price selectable" data-package="Detailing Mesin Mobil" data-price="40000"
                        data-time="60">
                        <h5>Detailing Mesin Mobil</h5>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp40.000</h6>
                            <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi 1 jam</p>
                        </div>
                    </div>
                    <div class="card-price selectable" data-package="Detailing Ban & Velg" data-price="30000"
                        data-time="30">
                        <h5>Detailing Ban & Velg</h5>
                        <div class="price mt-3">
                            <p>Harga</p>
                            <h6 class="service-price">Rp30.000</h6>
                            <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi 30 menit</p>
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
                                data-booked="{{ $vehicle->hasActiveBooking() ? 'true' : 'false' }}">
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
                        <div class="form-row">
                            <div class="form-col">
                                <label for="time">Pilih Waktu<span>*</span></label>
                                <select name="time" id="time" class="form-control booking-time" required>
                                    <option value="" disabled selected>Pilih Jam Kedatangan</option>
                                    @foreach ($slots as $slot => $available)
                                        @if ($available)
                                            <option value="{{ $slot }}">{{ $slot }}</option>
                                        @else
                                            <option value="{{ $slot }}" disabled>{{ $slot }} - Sudah
                                                Dipesan</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tombol Reset dan Pesan Sekarang --}}
            <div class="order-menu mt-5">
                <button class="btn-reset">Reset</button>
                <button class="btn-next" type="submit">Pesan Sekarang</button>
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
