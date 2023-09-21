<?php

namespace App\Models\Recommand;

use App\Models\Member;
use App\Models\Office;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssemblyProof extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'region_id',
        'parish_id',
        'local_church_id',
        'status',
        'applyBy',
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
