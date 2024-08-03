<!DOCTYPE html>
<html>

<head>
    <title>Bukti Pembayaran</title>
</head>

<body>
    <h5>Pesanan Layanan Anda Telah Dibuat</h5>
    <div class="detail-order">
        <div class="pay-logo">
            <img src="{{ public_path('image/iwash-full-logo.png') }}" alt="">
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
        </div>
    </div>
</body>

</html>
