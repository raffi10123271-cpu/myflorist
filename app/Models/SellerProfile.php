<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'shop_name',
        'phone',
        'address',
        'logo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
