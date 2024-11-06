<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistic extends Model
{
    use HasFactory;
    protected $fillable=[

        'uuid',
        'name',
        'value',
        'matches_id'
    ];
    public function matche(){
        return $this->belongsTo(matche::class,'matches_id');
    }

    
        public function information(){
        return $this->hasMany(information::class);
    }


}

