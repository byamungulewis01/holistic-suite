<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenPrays extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fatherName',
        'motherName',
        'parentPhone',
        'gender',
        'dateOfBirth',
        'applyBy',
        'status',
        'local_church_id',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',
    ];
}
