<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    protected $fillable = ['card_title', 'card_number', 'card_name', 'card_expiration_date', 'card_cvv'];

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
