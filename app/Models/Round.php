<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function MatchRelation(){ // 1 - M relationship (One)
        return $this->hasMany(MatchModel::class);
    }
}
