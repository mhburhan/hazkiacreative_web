<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relasi dengan Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi dengan Product (jika Anda memiliki model Product)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}