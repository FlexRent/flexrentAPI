<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $fillable = ['address_title', 'street', 'number', 'complement', 'district', 'city', 'state', 'country', 'zipcode', 'user_id'];

    public function Users()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
