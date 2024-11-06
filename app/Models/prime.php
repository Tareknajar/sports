<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prime extends Model
{
    use HasFactory;
    protected $fillable=[
        'uuid'	,'name'	,'descreption'	,'image'	,'type'	,'Sports_id'	,'seasons_id'
    ];
    public function sport(){
        return $this->belongsTo(sport::class,'Sports_id');
    }
    public function seasons(){
        return $this->belongsTo(seasone::class,'seasons_id');
    }
}
