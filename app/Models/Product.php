<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'images', 'description', 'category_id', 'price', 'quantity', 'sku', 'weight'];

    public function getImagesAttribute($value) {
        return json_decode($value, true);
    }

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function reviews(){
        return $this->hasMany(Reviews::class);
    }
}
