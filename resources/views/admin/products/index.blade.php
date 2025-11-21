@extends('layouts.admin')

@section('title', 'Products Management')

@section('page-title', 'Products Management')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-mug-hot"></i> All Products</h3>
        <div class="card-tools">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Product
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products ?? [] as $product)
                <tr>
                    <td>
                        @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" width="50" height="50" style="object-fit: cover;">
                        @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-coffee text-white"></i>
                        </div>
                        @endif
                    </td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge badge-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No products found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($products))
    <div class="card-footer">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection