@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">Daftar Produk</h1>

    {{-- Filter + Search --}}
    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-3 d-flex">
        <select name="category" class="form-select w-25 me-2">
            <option value="">— Semua Kategori —</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request()->category == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="search" class="form-control me-2"
               placeholder="Cari produk..."
               value="{{ request()->search }}">

        <button class="btn btn-primary">Filter</button>
    </form>

    {{-- List Produk --}}
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $products->links() }}

</div>
@endsection
