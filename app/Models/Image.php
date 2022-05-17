<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Image extends Model
{
    use HasFactory, SoftDeletes;

    public function model() // Eloquent Polymorphic Relations
    {
        return $this->morphTo();
    }
}
