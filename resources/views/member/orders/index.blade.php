@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-history"></i> Riwayat Pesanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Riwayat Pesanan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if(isset($orders) && count($orders) > 0)
        @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-0">Order #{{ $order->id }}</h5>
                        <small class="text-muted"><i class="fas fa-calendar"></i> {{ $order->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }} badge-lg">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</h6>
                        <p class="mb-2">{{ $order->address ?? 'N/A' }}</p>
                        <h6><i class="fas fa-phone"></i> Nomor Telepon</h6>
                        <p>{{ $order->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4 text-right">
                        <h5 class="text-success mb-3">Rp {{ number_format($order->total, 0, ',', '.') }}</h5>
                        <a href="{{ route('member.orders.show', $order->id) }}" class="btn btn-primary">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
        @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                <h3>Belum Ada Pesanan</h3>
                <p class="text-muted">Anda belum pernah melakukan pemesanan</p>
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag"></i> Mulai Belanja
                </a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection