<?php

namespace App\Models\Recommand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
