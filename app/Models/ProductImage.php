<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    private $fillable = ['product_id', 'image'];

    public function Product(){
        return $this->hasOne(Product::class, 'product_id');
    }
}
