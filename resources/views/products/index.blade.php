@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="display-4 mb-3"><i class="fas fa-mug-hot"></i> Daftar Produk</h1>
            <p class="lead text-muted">Temukan kopi favorit Anda</p>
        </div>
    </div>

    {{-- Filter + Search --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('home') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-filter"></i> Kategori</label>
                            <select name="category" class="form-control">
                                <option value="">— Semua Kategori —</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request()->category == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-search"></i> Cari Produk</label>
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari produk..."
                                value="{{ request()->search }}">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- List Produk --}}
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm hover-shadow transition">
                @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-coffee fa-4x text-white"></i>
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted small">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    <p class="card-text"><strong class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                    <p class="card-text small">Stok: {{ $product->stock }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-block">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Tidak ada produk ditemukan.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
    }

    .transition {
        transition: all 0.3s ease;
    }
</style>
@endsection