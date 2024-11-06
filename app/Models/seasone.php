<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seasone extends Model
{
    use HasFactory;

    protected $fillable=['uuid',	'name',	'start_date',	'end_date'];
    
    public function match(){
        return $this->hasMany(matche::class);
    }
    public function wear(){
        return $this->hasMany(wear::class);
    }
    public function prime(){
        return $this->hasMany(prime::class);
    }

    public function standing(){
        return $this->hasMany(standing::class);
    }
}
