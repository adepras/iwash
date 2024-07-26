@extends('layouts.app')

@section('title', 'iWash | Harga')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/price.css') }}">

    <div class="container-harga">
        <h2 class="mb-4">Harga bersahabat hasil mantap.</h2>
        <p>Kami menawarkan paket pencucian sesuai dengan kebutuhan Anda.</p>
        <div class="harga-content">
            <img src="image/character-top-ill.svg" alt="" style="margin-left: -100px;">
            <div class="card-container">
                <div class="card">
                    <div class="card-title">
                        <img src="image/p-basic.png" alt="">
                        <h4>Basic</h4>
                        <p>Membersihkan seluruh bagian mobil (eksterior dan interior) menggunakan sampo
                            Meguiar's Gold Class dan peralatan standar profesional.</p>
                    </div>
                    <ul class="text-card">
                        <li><img src="image/check-ill.png" alt="">Hand Wash</li>
                        <li><img src="image/check-ill.png" alt="">Interior Cleaning</li>
                        <li><img src="image/check-ill.png" alt="">Vacuum</li>
                        <li><img src="image/check-ill.png" alt="">Tire Polish</li>
                    </ul>
                    <p class="price">Rp 50.000</p>
                </div>
                <div class="card">
                    <div class="card-title">
                        <img src="image/p-standard.png" alt="">
                        <h4>Standard</h4>
                        <p>Paket Basic + membersihkan bercak atau noda berkerak pada permukaan cat dan bagian
                            mesin.</p>
                    </div>
                    <ul class="text-card">
                        <li style="font-weight: 600"><img src="image/check-ill.png" alt="">All in
                            Basic</li>
                        <li><img src="image/check-ill.png" alt="">Foam Wash</li>
                        <li><img src="image/check-ill.png" alt="">Spot Remover (Body)</li>
                        <li><img src="image/check-ill.png" alt="">Engine Cleaning</li>
                    </ul>
                    <p class="price">Rp 75.000</p>
                </div>
                <div class="card">
                    <div class="card-title">
                        <img src="image/p-professional.png" alt="">
                        <h4>Professional</h4>
                        <p>Paket Standard + membersihkan jamur, kerak pada kaca mobil dan noda aspal pada
                            permukaan cat mobil.</p>
                    </div>
                    <ul class="text-card">
                        <li style="font-weight: 600"><img src="image/check-ill.png" alt="">All in
                            Standard</li>
                        <li><img src="image/check-ill.png" alt="">Spot Remover (Window)</li>
                        <li><img src="image/check-ill.png" alt="">Tar Remover</li>
                    </ul>
                    <p class="price">Rp 100.000</p>
                </div>
            </div>
        </div>
    </div>
@endsection
