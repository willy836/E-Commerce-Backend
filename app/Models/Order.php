<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'order_status', 'payment_method', 'payment_status', 'shipping_address', 'shipping_fee', 'tracking_number', 'completed_at'];
}
