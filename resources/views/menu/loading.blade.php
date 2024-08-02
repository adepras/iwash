@extends('layouts.app')

@section('title', 'iWash | Proses Pemesanan')

@section('content')
    <style>
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
    </style>
    <script type="text/javascript">
        function redirectToProcessBooking() {
            var bookingUrl = "{{ route('process_booking') }}";

            console.log("Redirecting to: " + bookingUrl);

            if (bookingUrl) {
                window.location.href = bookingUrl;
            } else {
                console.error("Redirect URL is empty or invalid.");
            }
        }

        // Atur waktu untuk redirect ke proses booking
        setTimeout(redirectToProcessBooking, 5000);
    </script>

    <body>
        <div class="loading-container">
            <div class="spinner-border text-primary" role="status">
            </div>
            <h1 class="mt-3">Sedang Memproses Pesanan Anda...</h1>
        </div>
    </body>
@endsection
