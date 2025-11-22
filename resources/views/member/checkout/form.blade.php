@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-credit-card"></i> Checkout</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('member.cart.index') }}">Keranjang</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Sukses!</h5>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Terdapat Kesalahan!</h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-shipping-fast"></i> Informasi Pengiriman</h3>
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

                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" checked>
                                    <label class="custom-control-label" for="bank_transfer">
                                        <strong>Transfer Bank</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="payment_method" id="cod" value="cod">
                                    <label class="custom-control-label" for="cod">
                                        <strong>Cash on Delivery (COD)</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="payment_method" id="ewallet" value="ewallet">
                                    <label class="custom-control-label" for="ewallet">
                                        <strong>E-Wallet</strong>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="fas fa-check-circle"></i> Buat Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-shopping-basket"></i> Ringkasan Pesanan</h3>
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

                <div class="callout callout-info">
                    <p class="mb-0">
                        <i class="fas fa-info-circle"></i> Dengan melakukan checkout, Anda menyetujui syarat dan ketentuan yang berlaku.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection