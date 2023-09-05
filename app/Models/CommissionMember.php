<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'commission_id',
        'member_id',
        'user_id',
        'period',
        'post',
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
