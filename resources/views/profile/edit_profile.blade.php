@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="container-profile py-5">
        <div class="profile-title">
            <h2>Selamat Datang, {{ $user->name }}</h2>
            <img id="profile-image"
                src="{{ $user->gender === 'female' ? asset('image/female-ill.png') : asset('image/male-ill.png') }}"
                alt="">
        </div>
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="profile-data">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}">

                <label for="phone_number">Nomor WhatsApp:</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">

                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender">
                    <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>

                <label for="address">Alamat Anda:</label>
                <input type="text" id="address" name="address" value="{{ $user->address }}">
            </div>
            <div class="btn-tools mt-3 mb-3">
                <button type="submit" id="btn-edit-save" class="btn-save">Save</button>
            </div>
        </form>
    </div>
@endsection