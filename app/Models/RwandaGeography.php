<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RwandaGeography extends Model
{
    use HasFactory;
    protected $table = 'rwanda_geography';
    protected $province = '';
    protected $fillable = [
        'Prov_ID', 'Province', 'Dist_ID', 'District', 'Sect_ID', 'Sector',
        'Cell_ID', 'Cell','Vill_ID', 'Village', 'Status', 'FID',
    ];
}
