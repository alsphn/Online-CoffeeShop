@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Produk</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" 
          method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="form-group mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
        </div>

        <div class="form-group mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" 
                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}">
        </div>

        <div class="form-group mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
        </div>

        <div class="form-group mb-3">
            <label>Gambar Produk</label><br>
            @if($product->image_path)
                <img src="{{ asset('storage/'.$product->image_path) }}" width="120" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
