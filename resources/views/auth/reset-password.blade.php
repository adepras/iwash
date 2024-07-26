@extends('layouts.app')

@section('title', 'iWash | Reset Password')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="container-reset py-5">
        <div class="container-form">
            <h1>Buat Password Baru</h1>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                <h2 class="mt-5">Masukan Password Baru Anda</h2>
                <div class="form-input mt-3 mb-5">
                    <label for="password">Password<span>*</span></label>
                    <input type="password" id="password" name="password" placeholder="Password minimal 8 karakter"
                        required>
                    <div class="show-password">
                        <input type="checkbox" id="show-password" onclick="togglePassword('password', 'show-password')">
                        <label for="show-password">Tampilkan password</label>
                    </div>
                    <div class="error-message" id="password-error"></div>
                    <label for="password_confirmation">Konfirmasi Password<span>*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Ulangi password" required>
                    <div class="show-password">
                        <input type="checkbox" id="show-password-confirmation"
                            onclick="togglePassword('password_confirmation', 'show-password-confirmation')">
                        <label for="show-password-confirmation">Tampilkan password</label>
                    </div>
                    <div id="password-mismatch-error" class="error-message">Password yang dimasukan tidak sama.</div>
                </div>
                <div class="btn-confirm mt-4">
                    <button type="submit" class="btn-submit">Reset Password</button>
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
    </script>
@endsection
