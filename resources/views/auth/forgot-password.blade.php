@extends('layouts.app')

@section('title', 'iWash | Verifikasi Email')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="container-forgot py-5">
        <div class="container-form">
            <h1>Lupa Password</h1>
            @if (session('status'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Email Verifikasi Terkirim',
                        text: '',
                        timer: 2500,
                        showConfirmButton: false
                    });
                </script>
            @endif
            <form method="POST" id="forgot-form" action="{{ route('password.email') }}">
                @csrf
                <h2 class="mt-5">Verifikasi Email</h2>
                <div class="form-input mt-3 mb-5">
                    <label for="email">Email<span>*</span></label>
                    <input type="email" id="email" name="email" placeholder="mail@domain.com" required>
                    <div class="error-message" id="email-error"></div>
                </div>
                <div class="btn-confirm mt-4">
                    <button type="submit" class="btn-submit">Kirim Email Verifikasi</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var emailField = document.getElementById('email');
        var emailError = document.getElementById('email-error');

        function validateField(field, errorField, errorMessage) {
            if (field.value.trim() === '') {
                errorField.textContent = errorMessage;
                errorField.style.display = 'block';
            } else {
                errorField.style.display = 'none';
            }
        }

        emailField.addEventListener('input', function() {
            validateField(emailField, emailError, 'Email belum diisi!');
        });

        document.getElementById('forgot-form').addEventListener('submit', function(event) {
            validateField(emailField, emailError, 'Email belum diisi!');
        });
    </script>
@endsection
