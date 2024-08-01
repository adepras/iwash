<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="" class="btn-list"><img src="/image/list.svg" alt=""></a>
        <div class="nav-button">
            @auth
                {{-- <button class="nav-profile" onclick="window.location.href='{{ route('admin.adminprofile') }}'">Profil</button> --}}
                <button class="nav-logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </div>
    </nav>
</header>
