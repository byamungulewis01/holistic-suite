<?php

namespace App\Models\Recommand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
