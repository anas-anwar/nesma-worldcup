<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityService extends Model
{
    use HasFactory, SoftDeletes;

    public function model() // Eloquent Polymorphic Relations
    {
        return $this->morphTo();
    }

    public function service()
    { // 1 - M relationship (Many)
        return $this->belongsTo(Service::class, 'service_id')->withTrashed();
    }
}
