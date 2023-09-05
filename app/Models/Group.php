<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory,HasUuids;
    // fillable
    protected $fillable = [
        'name',
        'code',
        'ministry_id',
        'startDate',
        'status',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
    ];
    // relations
    public function ministry()
    {
        return $this->belongsTo(Predefined::class);
    }
}
