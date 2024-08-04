@extends('layouts.app')

@section('title', 'Payment Success')

@section('content')
    <style>
        .container {
            text-align: center;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .container a {
            color: #2277b9;
            font-size: 15px;
            font-weight: 500;
        }

        .container a:hover {
            color: #333;
        }

        .container span {
            color: #2277b9;
            font-size: 15px;
            user-select: none;
            font-weight: 500;
        }

        .container a img {
            width: 15px;
            margin-right: 5px;
        }
    </style>

    <div class="container py-5 mt-5">
        <h2>Pembayaran Berhasil!</h2>
        <p>Pembayaran kamu telah berhasil di proses.</p>
        <a href="{{ route('home') }}"><img src="/image/back-to.svg" alt="">Kembali ke halaman awal</a>
        <span>atau</span>
        <a href="{{ route('profile') }}">Lihat status pesanan?</a>
    </div>
@endsection
