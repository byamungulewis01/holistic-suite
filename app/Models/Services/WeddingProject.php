<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'churchMember', 'boy_member_id', 'boy_name', 'boy_phone',
        'boy_father_name', 'boy_mother_name', 'boy_religion',
        'boy_religion_certificate', 'boy_national_id', 'boy_aids_certificate',
        'boy_ceribate_certificate', 'girl_member_id', 'girl_name',
        'girl_phone', 'girl_father_name', 'girl_mother_name', 'girl_religion',
        'girl_religion_certificate', 'girl_national_id', 'girl_aids_certificate',
        'girl_ceribate_certificate', 'region_id', 'parish_id', 'local_church_id',
        'proposedDate', 'applyBy', 'church', 'aproovedDate', 'aproovedBy',
        'rejectedDate', 'rejectedBy', 'comment','status'
    ];
}
