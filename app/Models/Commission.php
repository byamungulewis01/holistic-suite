<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commission extends Model
{
    use HasFactory,HasUuids;
    // fillable
    protected $fillable = [
        'code',
        'commission_id',
        'status',
        'region_id',
        'parish_id',
        'local_church_id',
        'user_id',
    ];
    // relashionship
    public function commission()
    {
        return $this->belongsTo(Predefined::class);
    }


}
