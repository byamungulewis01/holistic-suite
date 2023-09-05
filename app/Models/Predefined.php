<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predefined extends Model
{
    use HasFactory;

    protected $fillable = [
        'english',
        'kinyarwanda',
        'type',
    ];
}
