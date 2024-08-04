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
            <input type="hidden" name="time_booking" id="selected-time-booking" value="">
            <input type="hidden" name="vehicle_id" id="selected-vehicle-id" value="">

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
                {{-- Satu Kali Cuci --}}
                <h5>Pilih Paket Satu Kali Cuci</h5>
                <div class="price-menu">
                    <div class="card-price selectable" data-package="Paket Basic" data-price="50000" data-time="60">
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
                    <div class="card-price selectable" data-package="Paket Standard" data-price="60000" data-time="120">
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
                    <div class="card-price selectable" data-package="Paket Professional" data-price="70000" data-time="180">
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
                            <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi
                                3 jam</p>
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
                                <select name="time_booking" id="time" class="form-control booking-time" required>
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
                <button type="button" class="btn-reset">Reset</button>
                <button type="submit" class="btn-next">Pesan Sekarang</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.vehicle-item').click(function() {
                if ($(this).hasClass('disabled')) {
                    return;
                }
                $('.vehicle-item').removeClass('selected');
                $(this).addClass('selected');
                $('#selected-vehicle-id').val($(this).data('id'));
            });

            $('.card-price').click(function() {
                $('.card-price').removeClass('selected');
                $(this).addClass('selected');
                $('#selected-package').val($(this).data('package'));
                $('#selected-price').val($(this).data('price'));
                $('#selected-time').val($(this).data('time'));
            });

            $('.booking-time').change(function() {
                $('#selected-time-booking').val($(this).val());
            });

            $('.btn-reset').click(function() {
                $('.card-price, .vehicle-item').removeClass('selected');
                $('#selected-package, #selected-price, #selected-time, #selected-vehicle-id, #selected-time-booking')
                    .val('');
                $('#date').val('');
                $('#time').val('');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('date');
            const today = new Date();
            const year = today.getFullYear();
            const month = ('0' + (today.getMonth() + 1)).slice(-2);
            const day = ('0' + today.getDate()).slice(-2);
            const maxDate = `${year}-${month}-${day}`;

            dateInput.setAttribute('min', maxDate);

            const now = today.getHours();
            if (now >= 15) {
                dateInput.setAttribute('min', `${year}-${month}-${('0' + (today.getDate() + 1)).slice(-2)}`);
            }
        });
    </script>
@endsection
