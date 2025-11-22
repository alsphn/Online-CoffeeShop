@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('member.orders.index') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <h1 class="mb-4"><i class="fas fa-receipt"></i> Detail Pesanan #{{ $order->id }}</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Item Pesanan</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
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
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Pesanan</h5>
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
@endsection