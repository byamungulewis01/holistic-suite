<?php

namespace App\Models\Services;

use App\Models\Member;
use App\Models\Predefined;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrayerRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'prayers',
        'member_id',
        'status',
        'service_type_id',
        'applyBy',
        'local_church_id',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function service_type()
    {
        return $this->belongsTo(Predefined::class);
    }
}

