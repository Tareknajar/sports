<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class replacment extends Model
{
    use HasFactory;
    protected $fillable=[
        'uuid',
        'inplayer_id',
        'outplayer_id',
        'matches_id'
    ];
    public function inplayer(){
        return $this->belongsTo(player::class,'inplayer_id');
    }
    public function outplayer(){
        return $this->belongsTo(player::class,'outplayer_id');
    }





    public function match(){
        return $this->belongsTo(matche::class,'matches_id');
    }
}
