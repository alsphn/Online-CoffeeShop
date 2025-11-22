@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4"><i class="fas fa-credit-card"></i> Checkout</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-shipping-fast"></i> Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('member.checkout.process') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="address"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap *</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required placeholder="Masukkan alamat lengkap pengiriman..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="phone"><i class="fas fa-phone"></i> Nomor Telepon *</label>
                            <input type="text" name="phone" id="phone" class="form-control" required placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="form-group">
                            <label for="notes"><i class="fas fa-sticky-note"></i> Catatan (Opsional)</label>
                            <textarea name="notes" id="notes" class="form-control" rows="2" placeholder="Catatan untuk penjual..."></textarea>
                        </div>

                        <hr>

                        <h5 class="mb-3"><i class="fas fa-money-bill-wave"></i> Metode Pembayaran</h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" checked>
                            <label class="form-check-label" for="bank_transfer">
                                <strong>Transfer Bank</strong>
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod">
                            <label class="form-check-label" for="cod">
                                <strong>Cash on Delivery (COD)</strong>
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="ewallet" value="ewallet">
                            <label class="form-check-label" for="ewallet">
                                <strong>E-Wallet</strong>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-check-circle"></i> Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-basket"></i> Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    @if(isset($cartItems))
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong>{{ $item->product->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $item->quantity }}x Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                        </div>
                        <div>
                            <strong>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    @endif

                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total</h5>
                        <h5><strong class="text-success">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</strong></h5>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <p class="mb-0 text-muted small">
                        <i class="fas fa-info-circle"></i> Dengan melakukan checkout, Anda menyetujui syarat dan ketentuan yang berlaku.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection