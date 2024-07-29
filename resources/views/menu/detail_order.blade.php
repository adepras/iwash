@extends('layouts.app')

@section('title', 'iWash | Detail Pemesanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-detail-order py-5">
        <h2>Pesan Layanan iWash</h2>
        {{-- <a href="{{ url()->previous() }}"><img src="/image/back-to.svg" alt="">Kembali ke menu layanan</a> --}}
        <div class="container-detail mt-5 mb-2">
            <div class="layout-order">
                <h5>Detail Pemesanan dan Pembayaran</h5>
                <div class="detail-order">
                    <div class="pay-logo">
                        <img src="/image/iwash-full-logo.png" alt="">
                        <h6>ID Pemesanan : {{ $booking->id }}</h6>
                    </div>
                    <hr class="line">
                    <div class="detail-title">
                        <h6>Nomor Antrian </h6>
                        <h6>{{ $service }}</h6>
                        <p>{{ $package }}</p>
                        <ul>
                            <li>Total Harga :</li>
                            <li>Rp {{ number_format($booking->price, 0, ',', '.') }}</li>
                        </ul>
                        <ul>
                            <li>Total Estimasi :</li>
                            <li>{{ $estimated }} menit</li>
                        </ul>
                        <ul>
                            <li>Tanggal Pemesanan :</li>
                            <li>{{ $date_booking }}</li>
                        </ul>
                        <hr class="line">
                        <h6>Data Diri</h6>
                        <ul>
                            <li>Nama :</li>
                            <li>{{ $name }}</li>
                        </ul>
                        <ul>
                            <li>Nomor WhatsApp:</li>
                            <li>{{ $phone_number }}</li>
                        </ul>
                        <hr class="line">
                        <h6>Data Kendaraan</h6>
                        <ul>
                            <li>Brand :</li>
                            <li>{{ $vehicle_brand }}</li>
                        </ul>
                        <ul>
                            <li>Type :</li>
                            <li>{{ $vehicle_type }}</li>
                        </ul>
                        <ul>
                            <li>Nomor Polisi :</li>
                            <li>{{ $license_plate }}</li>
                        </ul>
                    </div>
                </div>
                <div class="order-menu pay-now mt-3">
                    <div class="pay-price">
                        <p>Total Pembayaran</p>
                        <h6>Rp {{ number_format($booking->price, 0, ',', '.') }}</h6>
                    </div>
                    <button class="btn-next" type="submit">Bayar</button>
                </div>
            </div>
            <div class="layout-faq">
                <div class="accordion" id="accordionExample">
                    <h2>FAQ</h2>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Bagaimana cara pembayarannya?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Pembayaran dapat dilakukan melalui transfer ke Bank yang tersedia via Virtual Account yang
                                diberikan pada proses pembayaran.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Proses datang ke tempat cuci?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Proses mengantri kendaraan dengan datang ke outlet iWash kemudian berikan bukti pemesanan
                                dan pembayaran yang dikirimkan melalui WhatsApp.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apa ada garansi?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Ada garansi cuci ulang selama 24 jam apabila dirasa kurang memuaskan. Tidak ada garansi
                                hujan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
