<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Children extends Model
{
    use HasFactory, HasUuids;
    // fillable
    protected $fillable = [
        'name',
        'fatherName',
        'motherName',
        'parentPhone',
        'province_id',
        'district_id',
        'sector_id',
        'cell_id',
        'village_id',
        'gender',
        'dateOfBirth',
        'dateOfPrayer',
        'disability',
        'insurance_id',
        'education_id',
        'status',
        'orphanStatus',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
        'member_id',
    ];
    // relationship
    public function education()
    {
        return $this->belongsTo(Predefined::class);
    }
}
