<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOdd extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function Matches(){ // 1 - M relationship (Many)
        return $this->belongsTo(MatchModel::class, 'match_id');
    }

    public function Accounts(){ // 1 - M relationship (Many)
        return $this->belongsTo(Account::class, 'account_id');
    }
}
