<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessments extends Model
{
    use HasFactory;

    protected $fillable = ['assessments', 'comments', 'user_id', 'product_id'];

    public function User()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function Product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }

}
