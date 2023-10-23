<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory,HasUuids;
    // fillable
    protected $fillable = [
        'name', 'type', 'province_id', 'district_id', 'sector_id', 'cell_id', 'village_id', 'reg_number', 'region_number', 'parish_number', 'local_church_number', 'user_id', 'wedding_price', 'phone', 'email'
    ];
}
