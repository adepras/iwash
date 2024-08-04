use Carbon\Carbon;
<?php use Carbon\Carbon; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pemesanan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice {
            width: 40%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .pay-logo img {
            width: 65px;
            display: block;
            margin: 0 auto 10px;
        }

        .pay-logo h6 {
            text-align: left;
            margin: 10px 0;
            font-size: 12px;
            color: #555;
        }

        .line {
            border: none;
            border-top: 1px solid #ddd;
            margin: 1px 0;
        }

        .detail-title h6 {
            margin: 5px 0;
            color: #333;
            font-size: 12px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 2px 0;
        }

        ul li {
            display: inline-block;
            width: 48%;
        }

        ul li:nth-child(odd) {
            text-align: left;
        }

        ul li:nth-child(even) {
            text-align: right;
        }

        .detail-title h6,
        .detail-title ul li {
            color: #555;
            font-size: 12px;
        }

        .status {
            text-align: left;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 12px;
            color: #333;
            background-color: #f4f4f4;
        }

        .detail-title p {
            margin: 10px 0;
            font-size: 10px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="detail-order invoice">
        <div class="pay-logo">
            <img src="{{ public_path('image/iwash-full-logo.png') }}" alt="">
            <h6 class="mb-3">ID : {{ $booking->id }}</h6>
        </div>
        <hr class="line">
        <div class="detail-title">
            <div class="d-flex justify-content-between">
                <h6>Waktu Kedatangan</h6>
                <h6>{{ Carbon::parse($booking->time_booking)->format('H:i') }} WIB</h6>
            </div>
            <h6>{{ $service }}</h6>
            <h6 class="mb-2">{{ $package }}</h6>
            <ul>
                <li>Total Harga</li>
                <li>Rp {{ number_format($booking->price, 0, ',', '.') }}</li>
            </ul>
            <ul>
                <li>Total Estimasi</li>
                <li>{{ $estimated }} menit</li>
            </ul>
            <ul>
                <li>Tanggal Pemesanan</li>
                <li>{{ $date_booking }}</li>
            </ul>
            <hr class="line">
            <h6>Data Pemesan</h6>
            <ul>
                <li>Nama</li>
                <li>{{ $name }}</li>
            </ul>
            <ul>
                <li>WhatsApp</li>
                <li>{{ $phone_number }}</li>
            </ul>
            <hr class="line">
            <h6>Data Kendaraan</h6>
            <ul>
                <li>Brand</li>
                <li>{{ $booking->vehicle->vehicle_brand ?? 'Tidak tersedia' }}</li>
            </ul>
            <ul>
                <li>Tipe</li>
                <li>{{ $booking->vehicle->vehicle_type ?? 'Tidak tersedia' }}</li>
            </ul>
            <ul>
                <li>Nomor Polisi</li>
                <li>{{ $booking->vehicle->license_plate ?? 'Tidak tersedia' }}</li>
            </ul>
            <div class="status {{ $booking->status == 'paid' ? 'paid' : 'pending' }}">
                Status {{ $booking->status == 'paid' ? 'Pembayaran Lunas' : 'Pembayaran Belum Lunas' }}
            </div>
            <p class="mt-3" ><span style="color: red;">*</span>Surat ini sebagai bukti pemesanan dan pembayaran yang sah.</p>
        </div>
    </div>
</body>

</html>
