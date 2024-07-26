@extends('layouts.app')

@section('title', 'iWash | Satu Kali Cuci')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="image/back-to.svg" alt="">Kembali ke jenis layanan</a>
        <div class="category-menu mt-5 mb-2" id="menu1">
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
                        <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 1 Jam
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
                        <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 1 Jam
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
                        <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 1 Jam
                        </p>
                    </div>
                    <div class="select-price">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="professional"
                            value="professional">
                    </div>
                </div>
            </div>
            <h5 class="mt-5">Pilih Kendaraan dari Profil Anda</h5>
            <div class="vehicle-list">
                @if ($vehicles)
                    @foreach ($vehicles as $vehicle)
                        <div class="vehicle-item" data-id="{{ $vehicle->id }}">
                            <p>{{ $vehicle->vehicle_brand }}</p>
                            <p>{{ $vehicle->vehicle_type }}</p>
                            <p>{{ $vehicle->license_plate }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No vehicles found.</p>
                @endif
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
    <script>
        $(document).ready(function() {
            let selectedVehicleId = null;
            let selectedPackage = null;

            // Klik Item
            $('.vehicle-item').click(function() {
                if (selectedVehicleId) {
                    $('.vehicle-item[data-id="' + selectedVehicleId + '"]').removeClass('selected');
                }
                selectedVehicleId = $(this).data('id');

                $('.vehicle-item').each(function() {
                    if ($(this).data('id') === selectedVehicleId) {
                        $(this).addClass('selected');
                    } else {
                        $(this).removeClass('selected');
                    }
                });
                checkOrderMenuVisibility();
            });

            $('input[name="flexRadioDefault"]').change(function() {
                selectedPackage = $(this).val();
                checkOrderMenuVisibility();
            });

            // Menampilkan Tombol Lanjutkan dan Tombol Reset
            function checkOrderMenuVisibility() {
                if (selectedVehicleId && selectedPackage) {
                    $('.order-menu').addClass('visible');
                } else {
                    $('.order-menu').removeClass('visible');
                }
            }

            // Tombol Lanjutkan
            $('.btn-next').click(function() {
                if (selectedPackage && selectedVehicleId) {
                    // Ambil data paket dipilih
                    const selectedService = $('input[name="flexRadioDefault"]:checked').closest(
                        '.card-price');
                    const serviceName = selectedService.find('h5').text().trim();
                    const servicePrice = selectedService.find('.price h6').text().trim();
                    const serviceTime = selectedService.find('.estimation').text().trim();

                    // Ambil data kendaraan dipilih
                    const vehicle = $('.vehicle-item[data-id="' + selectedVehicleId + '"]');
                    const vehicleBrand = vehicle.find('p').eq(0).text().replace('Brand: ', '');
                    const vehicleType = vehicle.find('p').eq(1).text().replace('Type: ', '');
                    const vehiclePlate = vehicle.find('p').eq(2).text().replace('Nomor Polisi: ', '');

                    const message =
                        `Paket yang dipilih:\n${serviceName}\nHarga: ${servicePrice}\nEstimasi: ${serviceTime}\n\nKendaraan yang dipilih:\nBrand: ${vehicleBrand}\nType: ${vehicleType}\nNomor Polisi: ${vehiclePlate}`;
                    alert(message);

                    // logika untuk menangani nilai yang dipilih
                } else {
                    alert('Silakan pilih paket dan kendaraan terlebih dahulu.');
                }
            });

            // Tombol Reset
            $('.btn-reset').click(function() {
                $('input[name="flexRadioDefault"]').prop('checked', false);
                $('.vehicle-item').removeClass('selected');
                $('.order-menu').removeClass('visible');
                selectedVehicleId = null;
                selectedPackage = null;
            });
        });
    </script>
@endsection
