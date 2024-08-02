<!-- resources/views/menu.blade.php -->
@extends('layouts.app')

@section('title', 'iWash | Menu Layanan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <div class="container-menu py-5">
        <h2>Pesan Layanan iWash</h2>
        <p class="mb-5">Mau pilih layanan apa?</p>
        <div class="option-menu">
            <a class="btn-menu" href="{{ route('menu1') }}" onclick="checkLogin(event)">Perawatan Satu Kali Cuci<img
                    src="image/next-ill.png" alt=""></a>
            <a class="btn-menu" href="{{ route('menu2') }}" onclick="checkLogin(event)">Salon Mobil / Detailing<img
                    src="image/next-ill.png" alt=""></a>
        </div>
        <p class="mt-4 mb-5" style="color: #bebebe; font-size: 18px;">Sebelum memiilih jenis layanan diatas,<br>kami sarankan untuk mendaftar atau login terlebih dahulu</p>
    </div>

    <script>
        var isLoggedIn = @json(Auth::check());

        function checkLogin(event) {
            event.preventDefault();
            if (!isLoggedIn) {
                Swal.fire({
                    title: 'Ooops!',
                    text: 'Silahkan Login atau Daftar terlebih dahulu.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('menu') }}";
                    }
                });
            } else {
                window.location.href = event.target.href;
            }
        }
    </script>
@endsection
