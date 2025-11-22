@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-receipt"></i> Detail Pesanan #{{ $order->id }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('member.orders.index') }}">Riwayat Pesanan</a></li>
                    <li class="breadcrumb-item active">Detail #{{ $order->id }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="mb-3">
            <a href="{{ route('member.orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Sukses!</h5>
            {{ session('success') }}
        </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title"><i class="fas fa-list"></i> Item Pesanan</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <h5>Total</h5>
                                    </td>
                                    <td>
                                        <h5><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></h5>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi Pesanan</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong></p>
                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }} badge-lg">
                            {{ ucfirst($order->status) }}
                        </span>

                        <hr>

                        <p><strong>Tanggal Pesanan:</strong></p>
                        <p>{{ $order->created_at->format('d M Y H:i') }}</p>

                        <hr>

                        <p><strong><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman:</strong></p>
                        <p>{{ $order->address ?? 'N/A' }}</p>

                        <hr>

                        <p><strong><i class="fas fa-phone"></i> Nomor Telepon:</strong></p>
                        <p>{{ $order->phone ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection