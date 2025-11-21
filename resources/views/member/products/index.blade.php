@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h1 class="mb-4">Produk Untuk Member</h1>

    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <select class="form-control" name="category">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request()->category == $cat->id ? 'selected':'' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <input type="text" class="form-control" name="search" placeholder="Cari produk..."
                   value="{{ request()->search }}">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <div class="row">
        @forelse($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">

                @if($product->image_path)
                <img src="{{ asset('storage/'.$product->image_path) }}" class="card-img-top" style="height:200px;object-fit:cover;">
                @else
                <div class="bg-secondary card-img-top d-flex justify-content-center align-items-center" style="height:200px;">
                    <i class="fas fa-coffee fa-3x text-white"></i>
                </div>
                @endif

                <div class="card-body">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ $product->category->name ?? '-' }}</p>
                    <strong>Rp {{ number_format($product->price,0,',','.') }}</strong>

                    <form action="{{ route('member.cart.add', $product->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="btn btn-success btn-sm w-100">
                            Add to Cart
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Tidak ada produk ditemukan</p>
        @endforelse
    </div>

    {{ $products->links() }}

</div>
@endsection
