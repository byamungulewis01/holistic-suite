<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'member_id',
        'user_id',
        'isLeader',
        'post',
    ];
    // relationship
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
