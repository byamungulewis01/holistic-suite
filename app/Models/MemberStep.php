<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'step',
        'date',
        'spouse_name',
        'region_id',
        'parish_id',
        'local_church_id',
    ];

    public function region()
    {
        return $this->belongsTo(Office::class);
    }
    public function parish()
    {
        return $this->belongsTo(Office::class);
    }
    public function localChurch()
    {
        return $this->belongsTo(Office::class);
    }
}
