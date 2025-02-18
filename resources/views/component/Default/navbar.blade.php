<!-- filepath: /e:/Project CV/Food/resources/views/component/Default/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="nav_container">
        <!-- Logo và tên web -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="text-decoration: none;">
            <img src="{{ asset('img/logo_chef.png') }}" alt="Logo" style="height: 70px; width: auto; margin-right: 10px;">
            <span class="nav_web-title">Balancia</span>
        </a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav bar">
                @guest
                    <!-- Navbar default -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('/') }}">About</a></li>
                @endguest

                @auth
                    @if(auth()->user()->role == 'Admin')
                        <!-- Navbar admin -->
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings') }}">Settings</a></li>
                    @elseif(auth()->user()->role == 'User')
                        <!-- Navbar user -->
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('/') }}">Profile</a></li>
                    @elseif(auth()->user()->role == 'Shop')
                        <!-- Navbar shop -->
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('shop.profile') }}">Profile</a></li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
            @guest
            <a href="#" class="nav_btn nav_btn-1 ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 50">
                    <rect x="5" y="5" width="170" height="40" rx="25" ry="25"></rect>
                </svg>
                Login
            </a>
            @endguest
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toggler = document.querySelector('.navbar-toggler');
        var navbarNav = document.querySelector('.navbar-collapse');

        toggler.addEventListener('click', function() {
            navbarNav.classList.toggle('show');
        });
    });

    let barItems = document.querySelectorAll(".bar li");

    barItems.forEach(function(item) {
        item.addEventListener("click", function() {
            barItems.forEach(function(el) {
                el.classList.remove("nav_menu_active");
            });
            this.classList.toggle("nav_menu_active");
        });
    });
</script>