<?php

namespace App\Models\Recommand;

use App\Models\Member;
use App\Models\Predefined;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PraiseRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'local_church_id',
        'date',
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
    public function service_type()
    {
        return $this->belongsTo(Predefined::class);
    }
}
