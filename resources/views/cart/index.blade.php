@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h1>

    @if(isset($cartItems) && count($cartItems) > 0)
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}" width="50" height="50" class="mr-3" style="object-fit: cover;">
                                        @endif
                                        <strong>{{ $item->product->name }}</strong>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control form-control-sm" style="width: 80px;" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td><strong>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</strong></td>
                                <td>
                                    <form action="{{ route('cart.delete', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus item ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calculator"></i> Ringkasan Belanja</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <strong>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total</h5>
                        <h5><strong>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</strong></h5>
                    </div>
                    <a href="{{ route('checkout.form') }}" class="btn btn-success btn-block btn-lg">
                        <i class="fas fa-check"></i> Checkout
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-block mt-2">
                        <i class="fas fa-arrow-left"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
        <h3>Keranjang Anda Kosong</h3>
        <p class="text-muted">Belum ada produk di keranjang Anda</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-shopping-bag"></i> Mulai Belanja
        </a>
    </div>
    @endif
</div>
@endsection