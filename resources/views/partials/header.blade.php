<link rel="stylesheet" href="{{ asset('css/header.css') }}">

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">iWash</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu') }}">Cuci Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('price') }}">Harga Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                </ul>
                <div class="d-flex nav-button">
                    @auth
                        <button class="nav-profile" onclick="window.location.href='{{ route('profile') }}'">Profil</button>
                        <button class="nav-logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <button class="nav-login" onclick="window.location.href='{{ route('login') }}'">Login</button>
                        <button class="nav-register"
                            onclick="window.location.href='{{ route('register') }}'">Daftar</button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
