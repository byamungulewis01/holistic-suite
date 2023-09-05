<?php

namespace App\Models\Recommand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaPreach extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'status',
        'socialMedia',
        'motor',
        'applyBy',
        'church',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',
        'comment',
    ];
}
