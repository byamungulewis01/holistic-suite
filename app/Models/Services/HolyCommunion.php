<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
