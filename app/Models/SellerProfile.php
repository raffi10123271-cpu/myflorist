<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
   protected $fillable = [
        'user_id',
        'store_name',
        'store_phone',
        'store_address',
        'store_description',
        'store_logo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
}
