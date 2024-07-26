@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="image/back-to.svg" alt="">Kembali ke jenis layanan</a>
        <div class="category-menu mt-5 mb-2">
            <h5>Pilih Paket Salon Mobil / Detailing</h5>
            <p class="mt-4">Pilih ukuran mobil Anda</p>
            <div class="car-category">
                <button class="btn-car" id="small-car" data-size="small"><img src="image/small-car-ill.png"
                        alt="">Kecil</button>
                <button class="btn-car" id="medium-car" data-size="medium"><img src="image/medium-car-ill.png"
                        alt="">Sedang</button>
                <button class="btn-car" id="large-car" data-size="large"><img src="image/large-car-ill.png"
                        alt="">Besar</button>
            </div>
            <a href="">Cari tahu ukuran mobil Anda <img src="image/arrow-right.svg" alt=""></a>
            <p class="mt-4">Harga di bawah sudah sesuai dengan ukuran mobil Anda</p>
            <div class="price-menu">
                <div class="card-price" data-service="Detailing Interior" data-small-price="50000" data-medium-price="70000"
                    data-large-price="90000" data-small-time="1 Jam" data-medium-time="1.5 Jam" data-large-time="2 Jam">
                    <h5>Detailing Interior</h5>
                    <div class="price mt-3">
                        <p>Harga</p>
                        <h6 class="service-price">Rp -</h6>
                        <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi <span
                                class="service-time">- Jam</span></p>
                    </div>
                    <div class="select-price">
                        <input class="form-check-input" type="checkbox" name="flexCheckboxDefault"
                            value="Detailing Interior">
                    </div>
                </div>
                <div class="card-price" data-service="Detailing Eksterior" data-small-price="60000"
                    data-medium-price="80000" data-large-price="100000" data-small-time="1 Jam" data-medium-time="1.5 Jam"
                    data-large-time="2 Jam">
                    <h5>Detailing Eksterior</h5>
                    <div class="price mt-3">
                        <p>Harga</p>
                        <h6 class="service-price">Rp -</h6>
                        <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi <span
                                class="service-time">- Jam</span></p>
                    </div>
                    <div class="select-price">
                        <input class="form-check-input" type="checkbox" name="flexCheckboxDefault"
                            value="Detailing Eksterior">
                    </div>
                </div>
                <div class="card-price" data-service="Detailing Kaca Mobil" data-small-price="40000"
                    data-medium-price="60000" data-large-price="80000" data-small-time="1 Jam" data-medium-time="1.5 Jam"
                    data-large-time="2 Jam">
                    <h5>Detailing Kaca Mobil</h5>
                    <div class="price mt-3">
                        <p>Harga</p>
                        <h6 class="service-price">Rp -</h6>
                        <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi <span
                                class="service-time">- Jam</span></p>
                    </div>
                    <div class="select-price">
                        <input class="form-check-input" type="checkbox" name="flexCheckboxDefault"
                            value="Detailing Kaca Mobil">
                    </div>
                </div>
                <div class="card-price" data-service="Detailing Mesin Mobil" data-small-price="50000"
                    data-medium-price="70000" data-large-price="90000" data-small-time="1 Jam" data-medium-time="1.5 Jam"
                    data-large-time="2 Jam">
                    <h5>Detailing Mesin Mobil</h5>
                    <div class="price mt-3">
                        <p>Harga</p>
                        <h6 class="service-price">Rp -</h6>
                        <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi <span
                                class="service-time">- Jam</span></p>
                    </div>
                    <div class="select-price">
                        <input class="form-check-input" type="checkbox" name="flexCheckboxDefault"
                            value="Detailing Mesin Mobil">
                    </div>
                </div>
                <div class="card-price" data-service="Detailing Ban & Velg" data-small-price="40000"
                    data-medium-price="60000" data-large-price="80000" data-small-time="1 Jam"
                    data-medium-time="1.5 Jam" data-large-time="2 Jam">
                    <h5>Detailing Ban & Velg</h5>
                    <div class="price mt-3">
                        <p>Harga</p>
                        <h6 class="service-price">Rp -</h6>
                        <p class="estimation mt-3"><img src="image/stopwatch.svg" alt="">Estimasi <span
                                class="service-time">- Jam</span></p>
                    </div>
                    <div class="select-price">
                        <input class="form-check-input" type="checkbox" name="flexCheckboxDefault"
                            value="Detailing Ban & Velg">
                    </div>
                </div>
            </div>
        </div>
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
        <div class="order-menu mt-5">
            <button class="btn-reset">Reset</button>
            <button class="btn-next">Pesan Sekarang</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function updatePricesAndTimes(size) {
                $('.card-price').each(function() {
                    var price = $(this).data(size + '-price');
                    var time = $(this).data(size + '-time');
                    $(this).find('.service-price').text('Rp ' + price);
                    $(this).find('.service-time').text(time);
                });
            }

            function setActiveSizeButton(size) {
                $('.btn-car').css('opacity', '0.5');
                $('#' + size + '-car').css('opacity', '1');
            }

            // Setup biar ukuran mobil kecil yang terpilih saat pertama kali load halaman
            function resetSelections() {
                $('.btn-car').css('opacity', '0.5');
                $('#small-car').css('opacity', '1');
                updatePricesAndTimes('small');
            }
            setActiveSizeButton('small');
            updatePricesAndTimes('small');

            $('.btn-car').click(function() {
                var size = $(this).data('size');
                updatePricesAndTimes(size);
                setActiveSizeButton(size);
            });

            $('.card-price').click(function() {
                $(this).find('input[name="flexCheckboxDefault"]').prop('checked', function(i, value) {
                    return !value;
                }).trigger('change');
            });

            $('.btn-next').click(function() {
                var selectedSize = $('.btn-car').filter(function() {
                    return $(this).css('opacity') == 1;
                }).data('size');

                var selectedServices = $('input[name="flexCheckboxDefault"]:checked').map(function() {
                    return {
                        service: this.value,
                        price: $(this).closest('.card-price').find('.service-price').text(),
                        time: $(this).closest('.card-price').find('.service-time').text()
                    };
                }).get();

                var message = 'Ukuran Mobil: ' + (selectedSize ? selectedSize : 'None');
                if (selectedServices.length > 0) {
                    message += '\nPaket yang dipilih:\n' + selectedServices.map(function(service) {
                        return service.service + '\nHarga: ' + service.price + '\nEstimasi: ' +
                            service.time;
                    }).join('\n');
                }

                alert(message);
            });

            $('.btn-reset').click(function() {
                resetSelections();
            });
        });
    </script>

@endsection
