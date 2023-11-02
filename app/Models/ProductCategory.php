<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }

    public function reviews(){
        return $this->belongsToMany(Review::class, 'product_category_review', 'product_category_id', 'review_id');
    }
}
