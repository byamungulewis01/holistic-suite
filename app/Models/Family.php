<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $fillable = [
        'family_id',
        'member_id',
        'child_id',
        'relation',
    ];
    // relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function child()
    {
        return $this->belongsTo(Children::class);
    }

}
