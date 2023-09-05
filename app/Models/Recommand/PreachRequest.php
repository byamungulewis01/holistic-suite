<?php

namespace App\Models\Recommand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreachRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'status',
        'date',
        'places',
        'region_id',
        'parish_id',
        'local_church_id',
        'elseWhere',
        'abroad',
        'applyBy',
        'church',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',
        'comment'
    ];
}
