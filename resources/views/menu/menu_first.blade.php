@extends('layouts.app')

@section('title', 'iWash | Pesan Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-wash py-5">
        <h2>Pesan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="image/back-to.svg" alt="">Kembali ke jenis layanan</a>
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
                        <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 1 jam
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
                        <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 2 jam
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
                        <p class="estimation mt-3 service-time"><img src="image/stopwatch.svg" alt="">Estimasi 3 jam
                        </p>
                    </div>
                    <div class="select-price">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="professional"
                            value="professional">
                    </div>
                </div>
            </div>
            {{-- Add Satu Kali Cuci --}}
            <h5 class="mt-5">Add-ons Satu Kali Cuci</h5>
            <div class="add-menu">
                <div class="add-card">
                    <h5>Spot Remover - Body</h5>
                    <div class="add-service">
                        <p>Menghilangkan jamur & noda mengerak pada permukaan cat</p>
                    </div>
                    <div class="price">
                        <p>Harga</p>
                        <h6 class="service-price">Rp50.000</h6>
                        <p class="time mt-3">Estimasi ditambah 30 menit</p>
                    </div>
                    <div class="select-add">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="sr-body"
                            value="Spot Remover - Body">
                    </div>
                </div>
                <div class="add-card">
                    <h5>Spot Remover - Window</h5>
                    <div class="add-service">
                        <p>Menghilangkan jamur & noda mengerak pada kaca & jendela</p>
                    </div>
                    <div class="price">
                        <p>Harga</p>
                        <h6 class="service-price">Rp60.000</h6>
                        <p class="time mt-3">Estimasi ditambah 30 menit</p>
                    </div>
                    <div class="select-add">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="sr-window"
                            value="Spot Remover - Window">
                    </div>
                </div>
                <div class="add-card">
                    <h5>Claying</h5>
                    <div class="add-service">
                        <p>Menghilangkan kotoran mengendap pada permukaan mobil</p>
                    </div>
                    <div class="price">
                        <p>Harga</p>
                        <h6 class="service-price">Rp60.000</h6>
                        <p class="time mt-3">Estimasi ditambah 30 menit</p>
                    </div>
                    <div class="select-add">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="claying"
                            value="Claying">
                    </div>
                </div>
                <div class="add-card">
                    <h5>Sealing Wax Protection</h5>
                    <div class="add-service">
                        <p>Mengembalikan kilap & memberikan proteksi pada lapisan cat</p>
                    </div>
                    <div class="price">
                        <p>Harga</p>
                        <h6 class="service-price">Rp60.000</h6>
                        <p class="time mt-3">Estimasi ditambah 30 menit</p>
                    </div>
                    <div class="select-add">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="sw-protection"
                            value="Sealing Wax Protection">
                    </div>
                </div>
                <div class="add-card">
                    <h5>Fogging Disinfectant</h5>
                    <div class="add-service">
                        <p>Menghilangkan bakteri serta bau tak sedap dalam kabin mobil</p>
                    </div>
                    <div class="price">
                        <p>Harga</p>
                        <h6 class="service-price">Rp60.000</h6>
                        <p class="time mt-3">Estimasi ditambah 30 menit</p>
                    </div>
                    <div class="select-add">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="fogging"
                            value="Fogging Disinfectant">
                    </div>
                </div>
            </div>
        </div>
        <div class="data-order mt-5 mb-2">
            {{-- Layanan dipilih --}}
            <h5 class="mt-5">Layanan yang di pilih</h5>
            <div class="menu-selected">
                <div class="card-selected">
                    <div class="add-selected">
                        <h5>Basic</h5>
                        <h5>Spot Remover - Window</h5>
                    </div>
                    <div class="price">
                        <p>Total Harga</p>
                        <h6 class="service-price">Rp110.000</h6>
                        <p class="time mt-3">Total Estimasi 1 jam 30 menit</p>
                    </div>
                </div>
            </div>
            {{-- Pilih Kendaraan --}}
            <h5 class="mt-5">Pilih Kendaraan dari Profil Anda</h5>
            <div class="vehicle-list"></div>
            {{-- Atur Jadwal --}}
            <h5 class="mt-5">Atur Jadwal</h5>
            <div class="form-input mt-3 mb-5">
                <div class="form-row">
                    <div class="form-col">
                        <label for="date">Pilih Tanggal<span>*</span></label>
                        <input type="date" class="form-control" id="date" name="date-booking" required>
                    </div>
                    <div class="form-col">
                        <label for="time">Pilih Waktu<span>*</span></label>
                        <select class="form-control" id="booking_time" name="booking_time" required>
                            <option value="">Pilih Waktu</option>
                            <option value="08:00">08:00 WIB</option>
                            <option value="09:001">09:00 WIB</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="11:00">11:00 WIB</option>
                            <option value="12:00">12:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="14:00">14:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                            <option value="16:00">16:00 WIB</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-menu ">
            <div class="order-menu mt-5">
                <button class="btn-reset">Reset</button>
                <button class="btn-next">Pesan Sekarang</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
