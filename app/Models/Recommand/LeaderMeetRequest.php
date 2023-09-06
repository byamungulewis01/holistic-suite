<?php

namespace App\Models\Recommand;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaderMeetRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'leader',
        'reason',
        'church',
        'status',
        'applyBy',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',
        'service_type_id',
        'comment'
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
