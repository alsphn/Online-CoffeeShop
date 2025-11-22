<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'address',
        'phone',
        'payment_method',
        'payment_status',
    ];

    // relasi Order -> User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi Order -> OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // relasi Order -> Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
