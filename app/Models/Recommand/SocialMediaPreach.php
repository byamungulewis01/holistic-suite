<?php

namespace App\Models\Recommand;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialMediaPreach extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'status',
        'socialMedia',
        'motor',
        'applyBy',
        'church',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',
        'comment',
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
