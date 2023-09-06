<?php

namespace App\Models\Recommand;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'local_church_id',
        'status',
        'applyBy',
        'type',
        'description',
        'repliedBy',
        'reply',
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
