@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-mug-hot"></i> Daftar Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Filter + Search -->
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('home') }}" class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><i class="fas fa-filter"></i> Kategori</label>
                            <select name="category" class="form-control">
                                <option value="">— Semua Kategori —</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request()->category == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-search"></i> Cari Produk</label>
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari produk..."
                                value="{{ request()->search }}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" type="submit">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- List Produk -->
        <div class="row">
            @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-4">
                    @if($product->image_path)
                    <img src="{{ asset('storage/'.$product->image_path) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $product->name }}">
                    @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-gradient-purple text-white" style="height: 200px;">
                        <i class="fas fa-mug-hot fa-4x"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted mb-2"><small>{{ $product->category->name ?? 'Uncategorized' }}</small></p>
                        <p class="text-success font-weight-bold mb-2" style="font-size: 1.2rem;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-muted mb-3"><small>Stok: {{ $product->stock }}</small></p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-block">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info-circle"></i> Info</h5>
                    <p>Tidak ada produk ditemukan.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
        @endif
    </div>
</section>
@endsection