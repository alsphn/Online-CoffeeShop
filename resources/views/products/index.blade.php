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
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card product-card h-100 shadow-sm">
                @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                @else
                <div class="card-img-top product-placeholder">
                    <i class="fas fa-mug-hot"></i>
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="product-name">{{ $product->name }}</h5>
                    <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="product-stock">Stok: {{ $product->stock }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-block btn-detail">
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
    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .product-image {
        height: 225px;
        width: 100%;
        object-fit: cover;
        background-color: #f8f9fa;
    }

    .product-placeholder {
        height: 225px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .product-placeholder i {
        font-size: 80px;
        opacity: 0.9;
    }

    .product-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        margin-top: 0.5rem;
    }

    .product-category {
        font-size: 0.875rem;
        color: #6c757d;
        margin-bottom: 0.75rem;
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 0.5rem;
    }

    .product-stock {
        font-size: 0.875rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .btn-detail {
        background: #007bff;
        border: none;
        border-radius: 6px;
        padding: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .card-body {
        padding: 1.25rem;
    }

    /* Pagination styling */
    .pagination {
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
        display: inline-flex;
        align-items: center;
    }

    .pagination .page-item {
        margin: 0 3px;
    }

    .pagination .page-link {
        border-radius: 4px;
        border: 1px solid #dee2e6;
        color: #495057;
        padding: 8px 12px;
        font-size: 14px;
        min-width: 38px;
        min-height: 38px;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }

    /* Arrow icons - ukuran normal & fungsional */
    .pagination .page-link svg {
        width: 14px !important;
        height: 14px !important;
        display: block;
    }

    /* Ensure arrow buttons have same size as number buttons */
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        padding: 8px 12px;
        min-width: 38px;
        min-height: 38px;
    }
</style>
@endsection