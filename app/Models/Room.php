<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'type',
        'price',
        'url',
        'hotel_id'
    ];
    public function Hotels()
    { // 1 - M relationship (Many)
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
