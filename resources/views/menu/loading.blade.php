<!DOCTYPE html>
<html>
<head>
    <title>Loading</title>
    <script type="text/javascript">
        function redirectToProcessBooking() {
            var bookingUrl = "{{ route('process_booking') }}";
            
            console.log("Redirecting to: " + bookingUrl); // Debugging line

            if (bookingUrl) {
                window.location.href = bookingUrl;
            } else {
                console.error("Redirect URL is empty or invalid.");
            }
        }

        // Atur waktu untuk redirect ke halaman proses booking
        setTimeout(redirectToProcessBooking, 5000);
    </script>
</head>
<body>
    <h1>Please wait, processing your booking...</h1>
</body>
</html>
