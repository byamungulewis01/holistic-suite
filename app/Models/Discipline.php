<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory,HasUuids;
    protected $fillable = [
        'reason',
        'description',
        'expireDate',
        'category_id',
        'type',
        'status',
        'member_id',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
    ];
    // relations
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function category()
    {
        return $this->belongsTo(Predefined::class);
    }
}
