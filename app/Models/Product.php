<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'model', 'price', 'image', 'status', 'withdrawal_week', 'delivery_week', 'weekend_withdrawal', 'weekend_delivery', 'brand_id', 'brand_name', 'category_id', 'address_id'];

    public function ProductBrands()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    public function ProductCategories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ProductAddresses()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function ProductAssessments()
    {
        return $this->hasMany(Assessments::class, 'product_id');
    }

    public function Product(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
