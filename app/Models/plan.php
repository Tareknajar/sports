<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    use HasFactory;

    protected $fillable=[
        'uuid',
        'Players_id',
        'matches_id',
        'status'
    ];
    public function player(){
        return $this->belongsTo(player::class,'Players_id');
    }
    public function matche(){
        return $this->belongsTo(matche::class,'matches_id');
    }
}
