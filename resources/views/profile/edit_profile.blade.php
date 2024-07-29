@extends('layouts.app')

@section('title', 'iWash | Edit Profil')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="container-profile py-5">
        <div class="profile-title">
            <h2>Selamat Datang, {{ $user->name }}</h2>
            <img id="profile-image"
                src="{{ $user->gender === 'female' ? asset('/image/female-ill.png') : asset('/image/male-ill.png') }}"
                alt="">
        </div>
        <form action="{{ route('profile.update', $user->id) }}" method="POST" class="container-profile">
            @csrf
            @method('PUT')
            <div class="profile-data edit-mode">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" placeholder="Nama lengkap"
                    required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="" placeholder="Masukan alamat email baru"
                    required>

                <label for="phone_number">Nomor WhatsApp:</label>
                <input type="text" id="phone_number" name="phone_number" value=""
                    placeholder="Masukan nomor whatsapp baru" required>

                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender" required>
                    <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>

                <label for="address">Alamat Anda:</label>
                <input type="text" id="address" name="address" value="{{ $user->address }}"
                    placeholder="Masukan alamat lengkap baru" required>
            </div>
            <div class="btn-tools mt-3 mb-3">
                <button type="button" class="btn-back"
                    onclick="window.location.href='{{ url()->previous() }}'">Kembali</button>
                <button type="submit" id="btn-save" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
@endsection
