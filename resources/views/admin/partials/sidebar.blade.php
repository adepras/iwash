<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<script src="{{ asset('javascript/sidebar.js') }}" defer></script>

<aside class="sidebar">
    <div class="sidebar-header">
        <img src="/image/iwash-full-logo.png" alt="">
        <h5>Dashboard</h5>
    </div>
    <div class="sidebar-menu">
        <button type="button" id="dashboard" data-url="{{ route('admin.dashboard') }}">
            <img src="/image/app.svg" alt=""><span>Dashboard</span>
        </button>
        <button type="button" id="users" data-url="{{ route('admin.users') }}">
            <img src="/image/app.svg" alt=""><span>Data Pelanggan</span>
        </button>
        <button type="button" id="vehicle" data-url="{{ route('admin.vehicle') }}">
            <img src="/image/app.svg" alt=""><span>Data Kendaraan</span>
        </button>
        <button type="button" id="booking" data-url="{{ route('admin.booking') }}">
            <img src="/image/app.svg" alt=""><span>Data Pemesanan</span>
        </button>
        <button type="button" id="queue" data-url="{{ route('admin.queue') }}">
            <img src="/image/app.svg" alt=""><span>Data Antrian</span>
        </button>
    </div>
</aside>
