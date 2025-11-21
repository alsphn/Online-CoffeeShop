@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h2 class="mb-2"><i class="fas fa-user-circle"></i> Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="mb-0">Anda login sebagai <span class="badge badge-light text-primary">Member</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100 hover-card">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-bag fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Belanja Produk</h5>
                    <p class="card-text text-muted">Lihat koleksi kopi kami</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Lihat Produk
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100 hover-card">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Keranjang Belanja</h5>
                    <p class="card-text text-muted">Lihat item di keranjang</p>
                    <a href="{{ route('cart.index') }}" class="btn btn-success">
                        <i class="fas fa-arrow-right"></i> Ke Keranjang
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100 hover-card">
                <div class="card-body text-center">
                    <i class="fas fa-history fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Riwayat Pesanan</h5>
                    <p class="card-text text-muted">Cek pesanan Anda</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-info">
                        <i class="fas fa-arrow-right"></i> Lihat Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0"><i class="fas fa-list"></i> Pesanan Terakhir</h4>
                </div>
                <div class="card-body">
                    @if(isset($recentOrders) && count($recentOrders) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada pesanan</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Mulai Belanja
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
    }
</style>
@endsection