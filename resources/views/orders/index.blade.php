@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4"><i class="fas fa-history"></i> Riwayat Pesanan</h1>

    @if(isset($orders) && count($orders) > 0)
    <div class="row">
        @foreach($orders as $order)
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Order #{{ $order->id }}</h5>
                            <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                        </div>
                        <div>
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
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
        <h3>Belum Ada Pesanan</h3>
        <p class="text-muted">Anda belum pernah melakukan pemesanan</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-shopping-bag"></i> Mulai Belanja
        </a>
    </div>
    @endif
</div>
@endsection