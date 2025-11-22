<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        @auth
        @if(auth()->user()->role === 'member')
        <a class="navbar-brand" href="{{ route('member.dashboard') }}">
            <i class="fas fa-coffee"></i> Online CoffeeShop
        </a>
        @else
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-coffee"></i> Online CoffeeShop
        </a>
        @endif
        @else
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-coffee"></i> Online CoffeeShop
        </a>
        @endauth

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @auth
                <!-- Tombol Home -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}"
                        href="{{ route('member.dashboard') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                <!-- Tombol Menu -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        <i class="fas fa-coffee"></i> Menu
                    </a>
                </li>

                <!-- Tombol Cart -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('member.cart.index') ? 'active' : '' }}"
                        href="{{ route('member.cart.index') }}">
                        <i class="fas fa-shopping-cart"></i> Cart
                    </a>
                </li>

                <!-- Dropdown User -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                @else
                <!-- Kalau belum login -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
                @endif

                @endauth
            </ul>
        </div>
    </div>
</nav>