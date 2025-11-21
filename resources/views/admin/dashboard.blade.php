@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('page-title', 'Dashboard')

@section('breadcrumb')
<li class=\"breadcrumb-item active\">Dashboard</li>
@endsection

@section('content')
<!-- Info boxes -->
<div class=\"row\">
    <!-- Total Products -->
    <div class=\"col-lg-3 col-6\">
        <div class=\"small-box bg-info\">
            <div class=\"inner\">
                <h3>{{ $totalProducts ?? 0 }}</h3>
                <p>Total Products</p>
            </div>
            <div class=\"icon\">
                <i class=\"fas fa-mug-hot\"></i>
            </div>
            <a href=\"{{ route('admin.products.index') }}\" class=\"small-box-footer\">
                More info <i class=\"fas fa-arrow-circle-right\"></i>
            </a>
        </div>
    </div>

    <!-- Total Orders -->
    <div class=\"col-lg-3 col-6\">
        <div class=\"small-box bg-success\">
            <div class=\"inner\">
                <h3>{{ $totalOrders ?? 0 }}</h3>
                <p>Total Orders</p>
            </div>
            <div class=\"icon\">
                <i class=\"fas fa-shopping-cart\"></i>
            </div>
            <a href=\"{{ route('admin.orders.index') }}\" class=\"small-box-footer\">
                More info <i class=\"fas fa-arrow-circle-right\"></i>
            </a>
        </div>
    </div>

    <!-- Pending Orders -->
    <div class=\"col-lg-3 col-6\">
        <div class=\"small-box bg-warning\">
            <div class=\"inner\">
                <h3>{{ $pendingOrders ?? 0 }}</h3>
                <p>Pending Orders</p>
            </div>
            <div class=\"icon\">
                <i class=\"fas fa-clock\"></i>
            </div>
            <a href=\"{{ route('admin.orders.index') }}\" class=\"small-box-footer\">
                More info <i class=\"fas fa-arrow-circle-right\"></i>
            </a>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class=\"col-lg-3 col-6\">
        <div class=\"small-box bg-danger\">
            <div class=\"inner\">
                <h3>Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class=\"icon\">
                <i class=\"fas fa-money-bill-wave\"></i>
            </div>
            <a href=\"#\" class=\"small-box-footer\">
                More info <i class=\"fas fa-arrow-circle-right\"></i>
            </a>
        </div>
    </div>
</div>

<!-- Welcome Card -->
<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"card\">
            <div class=\"card-header\">
                <h3 class=\"card-title\">
                    <i class=\"fas fa-chart-pie mr-1\"></i>
                    Welcome to Admin Panel
                </h3>
            </div>
            <div class=\"card-body\">
                <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
                <p>Anda login sebagai <span class=\"badge badge-success\">Administrator</span></p>
                <hr>
                <p class=\"text-muted\">Gunakan menu di sebelah kiri untuk mengelola produk, pesanan, dan pengaturan lainnya.</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"card\">
            <div class=\"card-header\">
                <h3 class=\"card-title\">
                    <i class=\"fas fa-list mr-1\"></i>
                    Recent Orders
                </h3>
            </div>
            <div class=\"card-body p-0\">
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                <span class=\"badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}\">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan=\"5\" class=\"text-center\">No orders yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection