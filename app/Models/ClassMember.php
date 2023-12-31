<?php

namespace App\Models;

use App\Models\Services\WeddingProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'penitent_id',
        'teenager_id',
        'friend_id',
        'from',
        'member_id',
        'type',
        'status',
        'wedding_project_id',
    ];
    // relationships
    public function penitent()
    {
        return $this->belongsTo(Penitent::class);
    }
    public function teenager()
    {
        return $this->belongsTo(Teenager::class);
    }
    public function friend()
    {
        return $this->belongsTo(Friend::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function class ()
    {
        return $this->belongsTo(ClassStep::class);
    }
    public function wedding()
    {
        return $this->belongsTo(WeddingProject::class, 'wedding_project_id');
    }

}
