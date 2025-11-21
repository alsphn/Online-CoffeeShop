@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Tambah Produk</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Gambar Produk</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
