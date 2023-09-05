<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory, HasUuids;

    // fillable
    protected $fillable = [
        'reg_no',
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
        'ministry_id',
        'relation',
        'status',
        'photo',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
    ];

    //  relationship
    static function ministry($id)
    {
        return Predefined::whereIn('id', explode(',', $id))->get();
    }
    static function field($id)
    {
        return Predefined::whereIn('id', explode(',', $id))->get();
    }
    public function marital_status()
    {
        return $this->belongsTo(Predefined::class);
    }
    // saving
    public function saving_type()
    {
        return $this->belongsTo(Predefined::class,'saving_id');
    }
    // insurance
    public function insurance()
    {
        return $this->belongsTo(Predefined::class);
    }
    // local_church
    public function localChurch()
    {
        return $this->belongsTo(Office::class);
    }


}
