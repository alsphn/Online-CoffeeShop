@extends('layouts.admin')

@section('title', 'Orders Management')

@section('page-title', 'Orders Management')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list"></i> All Orders</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders ?? [] as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-control form-control-sm d-inline" style="width: auto;" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($orders))
    <div class="card-footer">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection