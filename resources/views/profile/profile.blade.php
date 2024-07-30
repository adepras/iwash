@extends('layouts.app')

@section('title', 'iWash | Profil')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="container-profile py-5">
        <div class="profile-title">
            <h2>Selamat Datang, {{ $user->name }}</h2>
            <img id="profile-image"
                src="{{ $user->gender === 'female' ? asset('image/female-ill.png') : asset('image/male-ill.png') }}"
                alt="">
        </div>
        <div class="profile-data">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" disabled>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" disabled>

            <label for="phone_number">Nomor WhatsApp:</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" disabled>

            <label for="gender">Jenis Kelamin:</label>
            <select id="gender" name="gender" disabled>
                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Laki-laki</option>
                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <label for="address">Alamat Anda:</label>
            <input type="text" id="address" name="address" value="{{ $user->address }}" disabled>
        </div>
        <div class="btn-tools mt-3 mb-3">
            <a href="{{ route('password.request') }}"><button type="button" class="btn-edit">Ganti Password</button></a>
            <a href="{{ route('profile.edit') }}"><button type="button" class="btn-edit">Edit</button></a>
        </div>
        {{-- Data Kendaraan --}}
        <div class="vehicle-data">
            <h2>Data Kendaraan Anda</h2>
            <div class="vehicle-display">
                <div class="vehicle-header">
                    <div class="header-item">Brand</div>
                    <div class="header-item">Type</div>
                    <div class="header-item">Nomor Polisi</div>
                    <div class="header-item">Hapus</div>
                </div>
                @forelse($vehicles as $vehicle)
                    <div class="vehicle-row">
                        <div class="vehicle-item">{{ $vehicle->vehicle_brand }}</div>
                        <div class="vehicle-item">{{ $vehicle->vehicle_type }}</div>
                        <div class="vehicle-item">{{ $vehicle->license_plate }}</div>
                        <div class="vehicle-item">
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove">
                                    <img src="{{ asset('image/remove-ill.png') }}" alt="Remove" class="remove-icon">
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="mt-2 mb-2">Belum ada data kendaraan.</p>
                @endforelse
            </div>
            <h2 class="mt-4">Tambah Data Kendaraan</h2>
            <div class="form-input mt-3">
                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-col">
                            <label for="vehicle_brand">Brand<span>*</span></label>
                            <input type="text" id="vehicle_brand" name="vehicle_brand" placeholder="Toyota" required>
                        </div>
                        <div class="form-col">
                            <label for="vehicle_type">Type<span>*</span></label>
                            <input type="text" id="vehicle_type" name="vehicle_type" placeholder="Kijang Innova"
                                required>
                        </div>
                        <div class="form-col">
                            <label for="license_plate">Nomor Polisi<span>*</span></label>
                            <input type="text" id="license_plate" name="license_plate" placeholder="H 1234 T" required>
                        </div>
                    </div>
                    <div class="btn-confirm mt-3">
                        <button type="submit" class="btn-submit">Tambah</button>
                    </div>
                </form>
            </div>
            <h2 class="mt-4" id="status-pemesanan">Status Pemesanan</h2>
            @if ($bookings->isEmpty())
                <p>Tidak ada pemesanan yang ditemukan.</p>
            @else
                <div class="detail-order mt-4">
                    @foreach ($bookings as $booking)
                        <div class="order-item mb-3 p-2 border rounded">
                            <h6>Nomor Antrian: {{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}</h6>
                            <p>Status: {{ $booking->status }}</p>
                            <p>Tanggal Pemesanan: {{ $booking->created_at->format('d-m-Y') }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
