<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitent extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'nid',
        'province_id',
        'district_id',
        'sector_id',
        'cell_id',
        'village_id',
        'gender',
        'dateOfBirth',
        'disability',
        'training',
        'professional',
        'employer',
        'insurance_id',
        'saving_id',
        'marital_status_id',
        'education_id',
        'field_id',
        'relation',
        'status',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
        'service_type_id',
        'previus_religion_id',
        'motif',
    ];

}
