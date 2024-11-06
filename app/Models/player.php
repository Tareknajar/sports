<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class player extends Model
{
    use HasFactory;
    protected $fallable=[
        'uuid',
        'name',
        'high',
        'play',
        'number',
        'born',
        'from',
        'first_club',
        'career',
        'image',
        'Sports_id',
    ];
    public function sport(){
        return $this->belongsTo(sport::class,'Sports_id');
    }
    public function replacmentin(){
        return $this->hasMany(replacment::class);
    }
    public function replacmentout(){
        return $this->hasMany(replacment::class);
    }
    public function plan(){
        return $this->hasMany(plan::class);
    }
}
