<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    public function AccountOdds(){ // 1 - M relationship (One)
        return $this->hasMany(AccountOdds::class);
    }

    
    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }

    
}
