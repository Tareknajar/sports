<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sport extends Model
{
    use HasFactory;
    protected $fillable=['uuid', 'name','image'];

    public function employee(){
        return $this->hasMany(employee::class);
    }
    public function club(){
        return $this->hasMany(club::class);
    }
    public function player(){
        return $this->hasMany(player::class);
    }
    public function wear(){
        return $this->hasMany(wear::class);
    }
    public function prime(){
        return $this->hasMany(prime::class);
    }
}              
