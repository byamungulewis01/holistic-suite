<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommandation extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'member_id',
        'from',
        'region_id',
        'parish_id',
        'local_church_id',
        'status',
        'reason',
        'aproovedDate',
        'aproovedBy',
        'rejectedDate',
        'rejectedBy',

    ];

     // relationships

     public function member()
     {
         return $this->belongsTo(Member::class);
     }
     public function region()
     {
         return $this->belongsTo(Office::class);
     }
     public function parish()
     {
         return $this->belongsTo(Office::class);
     }
     public function localChurch()
     {
         return $this->belongsTo(Office::class);
     }
}
