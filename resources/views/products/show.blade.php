@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 400px; object-fit: cover;">
                @else
                <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="fas fa-coffee fa-5x text-white"></i>
                </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $product->name }}</h1>

                    <div class="mb-3">
                        <span class="badge badge-primary">
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
                        <div class="form-group mb-3">
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

                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-block mt-3">
                        <i class="fas fa-arrow-left"></i> Kembali ke Produk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section (Optional) -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3 class="mb-4"><i class="fas fa-layer-group"></i> Produk Terkait</h3>
            <p class="text-muted">Produk lain dari kategori yang sama</p>
        </div>
    </div>
</div>
@endsection