<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $fillable = ['street', 'number', 'complement', 'district', 'city', 'state', 'country', 'zipcode'];

    public function Products()
    {
        return $this->hasMany(Product::class, 'address_id');
    }
}
