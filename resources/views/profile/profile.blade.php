@extends('layouts.app')

@section('title', 'iWash | Profil')

@section('content')
    <?php use Carbon\Carbon; ?>
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
                                    <img src="{{ asset('/image/remove-ill.png') }}" alt="Remove" class="remove-icon">
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
                        <div class="order-item mb-4" data-created-at="{{ $booking->created_at }}">
                            <div class="pay-status">
                                @if ($booking->status === 'paid')
                                    <p class="bg-success mb-2">Pemesanan sukses</p>
                                @elseif ($booking->status === 'pending')
                                    <p class="bg-warning mb-2">Menunggu pembayaran</p>
                                @elseif ($booking->status === 'cancelled')
                                    <p class="bg-danger mb-2">Pesanan Anda dibatalkan</p>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mt-4">
                                    <p>ID Pemesanan: {{ $booking->id }}</p>
                                    <p>Tanggal Pemesanan: {{ $booking->created_at->format('d M Y') }}</p>
                                    <p>Waktu: {{ Carbon::parse($booking->time_booking)->format('H:i') }} WIB</p>
                                    @if ($booking->status === 'pending')
                                        <button type="button" class="btn-detail mt-3"
                                            onclick="window.location.href='{{ route('detail_order', ['id' => $booking->id]) }}'">Detail</button>
                                        <div id="countdown-{{ $booking->id }}" class="countdown mt-2"
                                            style="color: red;" data-created-at="{{ $booking->created_at }}"></div>
                                    @elseif ($booking->status === 'paid')
                                        <button type="button" class="btn-cancel mt-3" data-bs-toggle="modal"
                                            data-bs-target="#cancelModal">
                                            Batalkan
                                        </button>
                                    @endif
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn-download"
                                        onclick="window.location.href='{{ route('download.receipt', ['id' => $booking->id]) }}'"><img
                                            src="{{ asset('/image/download-ill.png') }}" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel">Alasan Pembatalan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('cancelBooking', ['id' => $booking->id]) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="mb-3">
                                                <label for="reason" class="form-label">Beritahu kami kendala Anda</label>
                                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- Modal -->
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownElements = document.querySelectorAll('.countdown');

            countdownElements.forEach(function(element) {
                const createdAt = new Date(element.dataset.createdAt);
                const countdownTime = new Date(createdAt.getTime() + 5 * 60 * 1000);

                let warningShown = false;

                const interval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countdownTime - now;

                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    element.innerHTML = minutes + " menit " + seconds + " detik";

                    if (distance < 0) {
                        clearInterval(interval);
                        element.innerHTML = "EXPIRED";
                    } else if (distance <= 2 * 60 * 1000 && !warningShown) {
                        warningShown = true;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Waktu pembayaran pesanan Anda tersisa kurang dari 2 menit!',
                            timer: 1800,
                            showConfirmButton: false
                        });
                    }
                }, 1000);
            });
        });
    </script>
    <script>
        document.getElementById('cancelForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Mengambil form data
            let form = event.target;
            let formData = new FormData(form);

            // Mengirim data form menggunakan Fetch API
            fetch(form.action, {
                    method: form.method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Menampilkan SweetAlert
                        Swal.fire({
                            title: 'Pemesanan dibatalkan',
                            text: 'Pengembalian dana akan segera diproses, mohon tunggu.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '{{ route('profile') }}';
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat membatalkan pesanan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat membatalkan pesanan.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>

@endsection
