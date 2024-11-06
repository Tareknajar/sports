<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    use HasFactory;
    protected $fillable=['uuid','name','address','logo','Sports_id'];
    public function sport(){
        return $this->belongsTo(sport::class,'Sports_id');
    }
    public function match(){
        return $this->hasMany(matche::class);
    }
    public function match1(){
        return $this->hasMany(matche::class);
    }
    public function standing(){
        return $this->hasMany(standing::class);
    }
}
