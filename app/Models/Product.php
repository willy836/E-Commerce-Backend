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
}
