<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matche extends Model
{
    use HasFactory;


    protected $fillable=['uuid'	,'when'	,'status',	'plan'	,'channel'	,'round',	'play_ground'	,'seasons_id'	,'club1_id'	,'club2_id'];

    public function  seasone(){
        return $this->belongsTo(seasone::class,'seasons_id');
    }

    public function  club1(){
        return $this->belongsTo(club::class,'club1_id');
    }

    public function  club2(){
        return $this->belongsTo(club::class,'club2_id');
    }
    public function replacment(){
        return $this->hasMany(replacment::class);
    }
    public function plan(){
        return $this->hasMany(plan::class);
    }
    public function statistic(){
        return $this->hasMany(statistic::class);
    }
}
