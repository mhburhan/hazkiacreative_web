<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'total_amount',
        'status',
        'user_id',
        'payment_method', // Menambahkan metode pembayaran
        'payment_proof',  // Menambahkan bukti pembayaran // Pastikan untuk menambahkan user_id di sini
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}