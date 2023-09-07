<?php

namespace App\Models\Services;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuneralMember extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'member_id',
        'dateOfDeath',
        'dateOfFuneral',
        'deathCourse',
        'status',
        'applyBy',
        'local_church_id',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',
        'comment'
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
