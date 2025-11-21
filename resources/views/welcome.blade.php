<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online CoffeeShop - Kopi Berkualitas Terbaik</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #6B4423 0%, #3E2723 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .feature-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 3rem;
            color: #6B4423;
            margin-bottom: 1rem;
        }

        .btn-custom {
            background-color: #6B4423;
            color: white;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #5A3619;
            color: white;
            transform: scale(1.05);
        }

        .navbar-custom {
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: transparent;
            transition: background 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: #3E2723 !important;
        }

        .navbar-custom .nav-link {
            color: white !important;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-coffee"></i> Online CoffeeShop
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                    @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-user-shield"></i> Admin Panel
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('member.dashboard') }}">Dashboard</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <i class="fas fa-mug-hot fa-5x mb-4"></i>
            <h1>Selamat Datang di Online CoffeeShop</h1>
            <p>Nikmati kopi berkualitas terbaik dengan pengalaman belanja online yang mudah</p>
            <a href="{{ route('home') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-shopping-bag"></i> Belanja Sekarang
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 font-weight-bold">Mengapa Memilih Kami?</h2>
                <p class="lead text-muted">Alasan kenapa pelanggan memilih Online CoffeeShop</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-coffee feature-icon"></i>
                            <h4 class="font-weight-bold">Kopi Berkualitas</h4>
                            <p class="text-muted">Kami hanya menyediakan biji kopi pilihan dengan kualitas terbaik dari berbagai daerah</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-shipping-fast feature-icon"></i>
                            <h4 class="font-weight-bold">Pengiriman Cepat</h4>
                            <p class="text-muted">Pesanan Anda akan diproses dan dikirim dengan cepat ke alamat tujuan</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-shield-alt feature-icon"></i>
                            <h4 class="font-weight-bold">Pembayaran Aman</h4>
                            <p class="text-muted">Transaksi Anda dijamin aman dengan sistem pembayaran yang terpercaya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="display-4 font-weight-bold mb-4">Siap untuk Menikmati Kopi Terbaik?</h2>
            <p class="lead mb-4">Mulai belanja sekarang dan dapatkan pengalaman kopi yang tak terlupakan</p>
            <a href="{{ route('home') }}" class="btn btn-custom btn-lg mr-3">
                <i class="fas fa-store"></i> Lihat Produk
            </a>
            @guest
            <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-coffee"></i> Online CoffeeShop</h5>
                    <p class="text-muted">Nikmati kopi berkualitas terbaik</p>
                </div>
                <div class="col-md-6 text-right">
                    <p class="mb-0">&copy; 2025 Online CoffeeShop. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $('.navbar-custom').addClass('scrolled');
            } else {
                $('.navbar-custom').removeClass('scrolled');
            }
        });
    </script>
</body>

</html>