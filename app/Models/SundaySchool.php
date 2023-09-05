<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SundaySchool extends Model
{
    use HasFactory, HasUuids;

    // fillable properties
    protected $fillable = [
        'classIndex',
        'teacher_id',
        'class',
        'level',
        'status',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
    ];

    // relationship
    public function teacher()
    {
        return $this->belongsTo(Member::class);
    }
    // members
    public function members()
    {
        return $this->hasMany(SundaySchoolMember::class);
    }
}
