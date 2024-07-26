<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<script src="{{ asset('javascript/sidebar.js') }}"></script>

<aside class="sidebar" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <div class="sidebar-header">
        <img src="image/iwash-full-logo.png" alt="">
    </div>
    <ul class="sidebar-menu">
        <li><img src="image/dashboard-ill.png" alt=""><a href="{{ route('admin.dashboard') }}" id="dashboard">Dashboard</a></li>
        <li><img src="image/users-ill.png" alt=""><a href="{{ route('admin.users') }}" id="users">Pelanggan</a></li>
        <li><img src="image/booking-ill.png" alt=""><a href="{{ route('admin.booking') }}" id="booking">Pemesanan</a></li>
        <li><img src="image/queue-ill.png" alt=""><a href="{{ route('admin.queue') }}" id="queue">Antrian</a></li>
    </ul>
    <div class="btn-sidebar">
        <button class="btn-profile" onclick="window.location.href='{{ route('admin.adminprofile') }}'">Profil</button>
        <button class="btn-logout"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
