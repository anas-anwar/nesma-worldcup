<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    // protected $table = "favorite";
protected $fillable = [
    "account_id",
    "favoritable_id",
    "favoritable_type"
];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function hotels()
    {
        return $this->morphedByMany(Hotel::class, 'favoritable');
    }
 
}
