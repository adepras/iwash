@extends('layouts.app')

@section('title', 'iWash | Daftar')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="container-register py-5">
        <div class="container-form">
            <h1>Daftar layanan iWash</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h2 class="mt-5">Isi Data Diri</h2>
                <div class="form-input mt-3 mb-5">
                    {{-- Nama --}}
                    <label for="name">Nama<span>*</span></label>
                    <input type="text" id="name" name="name" placeholder="Isi nama lengkap"
                        value="{{ old('name') }}" required>
                    <div class="error-message" id="name-error"></div>
                    <div class="form-row">
                        <div class="form-col">
                            {{-- Nomor Whatsapp --}}
                            <label for="phone_number">Nomor WhatsApp<span>*</span></label>
                            <input type="text" id="phone_number" name="phone_number" placeholder="081122334455"
                                value="{{ old('phone_number') }}" required>
                            <div class="error-message" id="phone_number-error"></div>
                        </div>
                        <div class="form-col">
                            {{-- Email --}}
                            <label for="email">Email<span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="mail@domain.com"
                                value="{{ old('email') }}" required>
                            <div class="error-message" id="email-error"></div>
                        </div>
                    </div>
                    {{-- Jenis Kelamin --}}
                    <label>Jenis Kelamin<span>*</span></label>
                    <div class="form-radio">
                        <input type="radio" id="gender_male" name="gender" value="male"
                            {{ old('gender') == 'male' ? 'checked' : '' }} required>
                        <label for="gender_male">Laki-laki</label>
                        <input type="radio" id="gender_female" name="gender" value="female"
                            {{ old('gender') == 'female' ? 'checked' : '' }} required>
                        <label for="gender_female">Perempuan</label>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            {{-- Password 1 --}}
                            <label for="password">Password<span>*</span></label>
                            <input type="password" id="password" name="password" placeholder="Password minimal 8 karakter"
                                required>
                            <div class="show-password">
                                <input type="checkbox" id="show-password"
                                    onclick="togglePassword('password', 'show-password')">
                                <label for="show-password">Tampilkan password</label>
                            </div>
                            <div class="error-message" id="password-error"></div>
                        </div>
                        <div class="form-col">
                            {{-- Password 2 --}}
                            <label for="password_confirmation">Konfirmasi Password<span>*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi password" required>
                            <div class="show-password">
                                <input type="checkbox" id="show-password-confirmation"
                                    onclick="togglePassword('password_confirmation', 'show-password-confirmation')">
                                <label for="show-password-confirmation">Tampilkan password</label>
                            </div>
                            <div class="error-message" id="password_confirmation-error"></div>
                        </div>
                    </div>
                    <div id="password-mismatch-error" class="error-message">Password yang dimasukan tidak sama.</div>
                    {{-- Alamat --}}
                    <label for="address">Alamat Lengkap<span>*</span></label>
                    <input type="text" id="address" name="address" placeholder="Tuliskan dengan lengkap dan benar"
                        value="{{ old('address') }}" required>
                    <div class="error-message" id="address-error"></div>
                </div>
                <div class="btn-confirm mt-4">
                    <button type="button" class="btn-back"
                        onclick="window.location.href='{{ route('home') }}'">Kembali</button>
                    <button type="submit" class="btn-submit">Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, checkboxId) {
            var passwordField = document.getElementById(fieldId);
            var showPasswordCheckbox = document.getElementById(checkboxId);
            if (showPasswordCheckbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        var showPasswordLabels = document.querySelectorAll('label[for^="show-password"]');
        showPasswordLabels.forEach(function(label) {
            label.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });

        // Validasi password.
        var passwordField = document.getElementById('password');
        var passwordConfirmationField = document.getElementById('password_confirmation');
        var passwordMismatchError = document.getElementById('password-mismatch-error');
        var passwordError = document.getElementById('password-error');

        function validatePasswords() {
            if (passwordField.value !== passwordConfirmationField.value) {
                passwordMismatchError.style.display = 'block';
            } else {
                passwordMismatchError.style.display = 'none';
            }
            if (passwordField.value.length < 8) {
                passwordError.textContent = 'Password minimal 8 karakter!';
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }
        }

        passwordField.addEventListener('input', validatePasswords);
        passwordConfirmationField.addEventListener('input', validatePasswords);

        // Validasi inputan.
        var nameField = document.getElementById('name');
        var phoneNumberField = document.getElementById('phone_number');
        var emailField = document.getElementById('email');
        var addressField = document.getElementById('address');
        

        function validateField(field, errorFieldId, errorMessage) {
            var errorField = document.getElementById(errorFieldId);
            if (field.value.trim() === '') {
                errorField.textContent = errorMessage;
                errorField.style.display = 'block';
            } else {
                errorField.style.display = 'none';
            }
        }

        nameField.addEventListener('input', function() {
            validateField(nameField, 'name-error', 'Nama belum di isi!');
        });
        phoneNumberField.addEventListener('input', function() {
            validateField(phoneNumberField, 'phone_number-error', 'Nomor WhatsApp belum di isi!');
        });
        emailField.addEventListener('input', function() {
            validateField(emailField, 'email-error', 'Email belum di isi!');
        });
        addressField.addEventListener('input', function() {
            validateField(addressField, 'address-error', 'Alamat belum di isi!');
        });

        // Memeriksa semua inputan sebelum dikirim.
        document.querySelector('form').addEventListener('submit', function(event) {
            validateField(nameField, 'name-error', 'Nama belum di isi!');
            validateField(phoneNumberField, 'phone_number-error', 'Nomor WhatsApp belum di isi!');
            validateField(emailField, 'email-error', 'Email belum di isi!');
            validateField(addressField, 'address-error', 'Alamat belum di isi!');
        });
    </script>

@endsection
