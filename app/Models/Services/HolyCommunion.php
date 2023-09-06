<?php

namespace App\Models\Services;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HolyCommunion extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'status',
        'service',
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
}
