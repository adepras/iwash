@extends('layouts.app')

@section('title', 'iWash | Login')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="container-login py-5">
        <div class="container-form">
            <h1>Masuk layanan iWash</h1>
            @if (session('status'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Berhasil Diubah',
                        text: '',
                        timer: 2500,
                        showConfirmButton: false
                    });
                </script>
            @endif
            <form id="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                <h2 class="mt-5">Masuk Dengan Akun Anda</h2>
                <div class="form-input mt-3 mb-5">
                    {{-- Email --}}
                    <label for="email">Email<span>*</span></label>
                    <input type="email" id="email" name="email" placeholder="mail@domain.com"
                        value="{{ old('email') }}" required>
                    <div class="error-message" id="email-error"></div>
                    {{-- Password --}}
                    <label for="password">Password<span>*</span></label>
                    <input type="password" id="password" name="password" placeholder="Silahkan isi password akun Anda"
                        required>
                    <div class="form-row">
                        <div class="form-col">
                            <div class="show-password">
                                <input type="checkbox" id="show-password" onclick="togglePassword()">
                                <label for="show-password">Tampilkan Password</label>
                            </div>
                            <div class="error-message" id="password-error"></div>
                        </div>
                        <div class="form-col">
                            {{-- Lupa Password --}}
                            <a class="forgot-password" href="{{ route('password.request') }}">Lupa Passwod?</a>
                        </div>
                    </div>
                    <div class="btn-confirm mt-4">
                        <button type="button" class="btn-back"
                            onclick="window.location.href='{{ route('home') }}'">Kembali</button>
                        <button type="submit" class="btn-submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var showPasswordCheckbox = document.getElementById("show-password");
            if (showPasswordCheckbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        var showPasswordLabel = document.querySelector('label[for="show-password"]');
        showPasswordLabel.addEventListener('click', function(event) {
            event.preventDefault();
        });

        // Validasi inputan.
        var emailField = document.getElementById('email');
        var passwordField = document.getElementById('password');
        var emailError = document.getElementById('email-error');
        var passwordError = document.getElementById('password-error');

        function validateField(field, errorField, errorMessage) {
            if (field.value.trim() === '') {
                errorField.textContent = errorMessage;
                errorField.style.display = 'block';
            } else {
                errorField.style.display = 'none';
            }
        }

        function validatePasswordLength() {
            if (passwordField.value.length < 8) {
                passwordError.textContent = 'Password minimal 8 karakter!';
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }
        }

        emailField.addEventListener('input', function() {
            validateField(emailField, emailError, 'Email belum diisi!');
        });

        passwordField.addEventListener('input', validatePasswordLength);

        document.getElementById('login-form').addEventListener('submit', function(event) {
            validateField(emailField, emailError, 'Email belum diisi!');
            validatePasswordLength();
        });

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: '{{ $errors->first() }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection
