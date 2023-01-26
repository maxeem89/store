<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable=
        [
            'order_id',
            'product_color_size_id',
            'quantity',
            'price',
            'discount',
        ];
    protected $table='order_details';
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function productColorSize(){
        return $this->belongsTo(ProductColorSize::class, 'product_color_size_id');
    }
}
