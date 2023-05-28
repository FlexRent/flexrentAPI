<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'model', 'price', 'image', 'status', 'withdrawal_week', 'delivery_week', 'weekend_withdrawal', 'weekend_delivery', 'brand_id', 'category_id', 'address_id'];

    public function Brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function Categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Addresses()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
