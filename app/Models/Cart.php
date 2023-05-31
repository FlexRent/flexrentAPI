<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['dt_withdrawal', 'dt_delivery', 'daily', 'vl_safe', 'vl_guarantee', 'vl_total', 'user_id', 'product_id', 'address_id'];

    public function User()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function Product()
    {
        return $this->hasOne(Product::class, 'product_id');
    }

    public function Address()
    {
        return $this->hasOne(Address::class, 'address_id');
    }


}
