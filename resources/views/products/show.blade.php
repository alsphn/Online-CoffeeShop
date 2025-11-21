@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $product->name }}</h1>

    <img src="{{ asset('storage/'.$product->image) }}" width="300" class="mb-3">

    <p>Kategori: {{ $product->category->name }}</p>

    <p>Harga: <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>

    <p>Stok: {{ $product->stock }}</p>

    <p>{{ $product->description }}</p>

    <form action="/cart/add/{{ $product->id }}" method="POST">
        @csrf
        <button class="btn btn-success">Tambah ke Keranjang</button>
    </form>

</div>
@endsection
