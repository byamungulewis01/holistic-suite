<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SundaySchoolMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'sunday_school_id',
        'child_id',
    ];

    public function child()
    {
        return $this->belongsTo(Children::class,'child_id');
    }
    public function school()
    {
        return $this->belongsTo(SundaySchool::class,'sunday_school_id');
    }
}
