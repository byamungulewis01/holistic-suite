<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassStep extends Model
{
    use HasFactory,HasUuids;

    // fillable
    protected $fillable = [
        'name',
        'teacher_id',
        'step_id',
        'period',
        'status',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
    ];

    // relations
    public function teacher()
    {
        return $this->belongsTo(Member::class);
    }
    public function step()
    {
        return $this->belongsTo(Predefined::class);
    }
}
