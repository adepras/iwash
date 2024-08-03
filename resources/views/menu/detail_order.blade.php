@extends('layouts.app')

@section('title', 'iWash | Detail Pemesanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-detail-order py-5">
        <h2>Detail Pesanan Layanan iWash</h2>
        <a href="{{ route('menu') }}"><img src="/image/back-to.svg" alt="">Kembali ke menu layanan</a>
        <div class="container-detail mt-5 mb-2">
            <div class="layout-order">
                <h5>Pesanan Layanan Anda Telah Dibuat</h5>
                <div class="detail-order">
                    <div class="pay-logo">
                        <img src="/image/iwash-full-logo.png" alt="">
                        <h6>ID Pemesanan : {{ $booking->id }}</h6>
                    </div>
                    <hr class="line">
                    <div class="detail-title">
                        <h6>Waktu Kedatangan : {{ $booking->time_booking }}</h6>
                        <h6>{{ $service }}</h6>
                        <h6>{{ $package }}</h6>
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
                            <li>{{ $booking->vehicle->vehicle_brand ?? 'Tidak tersedia' }}</li>
                        </ul>
                        <ul>
                            <li>Type :</li>
                            <li>{{ $booking->vehicle->vehicle_type ?? 'Tidak tersedia' }}</li>
                        </ul>
                        <ul>
                            <li>Nomor Polisi :</li>
                            <li>{{ $booking->vehicle->license_plate ?? 'Tidak tersedia' }}</li>
                        </ul>
                        <h6 class="mt-4">Status {{ $status }}</h6>
                        <div class="d-flex justify-content-between">
                            <h6>Durasi Pembayaran</h6>
                            <span class="countdown" style="color: red;">--:--:--</span>
                        </div>
                        <p class="mt-2">Segera lakukan pembayaran sebelum durasi pembayaran habis untuk menghindari
                            pembatalan pemesanan secara otomatis.</p>
                    </div>
                </div>
                <div class="order-menu pay-now mt-3">
                    <div class="pay-price">
                        <p>Total Pembayaran</p>
                        <h6>Rp {{ number_format($booking->price, 0, ',', '.') }}</h6>
                    </div>
                    <button class="btn-next" id="pay-button">Bayar</button>
                </div>
                <button type="button" class="btn-back mt-3"
                    onclick="window.location.href='{{ route('profile') }}#status-pemesanan'">Lihat Status
                    Pemesanan</button>
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
                                Pembayaran dapat dilakukan melalui metode pembayaran yang tersedia sebelum durasi pembayaran
                                habis. Jika durasi pembayaran habis maka pemesanan akan otomatis dibatalkan.
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
                                Proses mengantri kendaraan dengan datang ke tempat dan kemudian berikan bukti pemesanan
                                dan pembayaran Anda.
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

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        // Countdown Timer
        function startCountdown(duration, display) {
            var timer = duration,
                hours, minutes, seconds;
            setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? '0' + hours : hours;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                display.textContent = hours + ':' + minutes + ':' + seconds;

                if (--timer < 0) {
                    window.location.href = "{{ route('cancel_booking', ['id' => $booking->id]) }}";
                }
            }, 1000);
        }

        window.onload = function() {
            var createdAt = new Date("{{ $booking->created_at }}").getTime();
            var now = new Date().getTime();
            var elapsed = Math.floor((now - createdAt) / 1000);
            var threeMinutes = 60 * 3;
            var remainingTime = threeMinutes - elapsed;

            if (remainingTime > 0) {
                var display = document.querySelector('.countdown');
                startCountdown(remainingTime, display);
            } else {
                window.location.href = "{{ route('cancel_booking', ['id' => $booking->id]) }}";
            }
        };
    </script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            console.log('Creating payment for booking: {{ $booking->id }}');
            fetch('{{ route('payment.create') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        booking_id: '{{ $booking->id }}'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        snap.pay(data.snap_token, {
                            onSuccess: function (result) {
                                alert("Payment Success");
                                console.log(result);
                                window.location.href = "{{ route('payment.success', ['id' => $booking->id]) }}";
                            },
                            onPending: function(result) {
                                console.log('Payment pending:', result);
                            },
                            onError: function(result) {
                                console.log('Payment error:', result);
                            }
                        });
                    } else if (data.error) {
                        console.error('Error:', data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
