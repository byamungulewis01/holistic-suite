<?php

namespace App\Models\Recommand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
