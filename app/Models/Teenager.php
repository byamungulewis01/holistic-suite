<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teenager extends Model
{
    use HasFactory,HasUuids;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'province_id',
        'district_id',
        'sector_id',
        'cell_id',
        'village_id',
        'gender',
        'dateOfBirth',
        'disability',
        'insurance_id',
        'saving_id',
        'education_id',
        'status',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
    ];
}
