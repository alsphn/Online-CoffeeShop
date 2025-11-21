<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'qty',
        'price',
    ];

    // Relasi item ke keranjang
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relasi item ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
