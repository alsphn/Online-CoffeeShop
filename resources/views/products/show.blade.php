@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Produk</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}" style="width: 100%; height: 400px; object-fit: cover;">
                        @else
                        <div class="bg-gradient-secondary d-flex align-items-center justify-content-center text-white" style="height: 400px;">
                            <i class="fas fa-mug-hot fa-5x"></i>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-3">{{ $product->name }}</h2>

                        <div class="mb-3">
                            <span class="badge badge-primary badge-lg">
                                <i class="fas fa-tag"></i> {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </div>

                        <h3 class="text-success mb-4">
                            <i class="fas fa-money-bill-wave"></i>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h3>

                        <div class="mb-3">
                            <h5><i class="fas fa-boxes"></i> Stok</h5>
                            <p class="lead">
                                @if($product->stock > 0)
                                <span class="badge badge-success">{{ $product->stock }} tersedia</span>
                                @else
                                <span class="badge badge-danger">Habis</span>
                                @endif
                            </p>
                        </div>

                        <div class="mb-4">
                            <h5><i class="fas fa-align-left"></i> Deskripsi</h5>
                            <p class="text-muted">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
                        </div>

                        <hr>

                        <!-- Add to Cart Form -->
                        @auth
                        @if($product->stock > 0)
                        <form action="{{ route('member.cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="quantity"><i class="fas fa-shopping-basket"></i> Jumlah</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-lg btn-block" disabled>
                            <i class="fas fa-times-circle"></i> Stok Habis
                        </button>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-sign-in-alt"></i> Login untuk Membeli
                        </a>
                        @endauth

                        <a href="{{ route('home') }}" class="btn btn-default btn-block mt-3">
                            <i class="fas fa-arrow-left"></i> Kembali ke Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection