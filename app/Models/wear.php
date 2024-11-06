<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wear extends Model
{
    use HasFactory;
    protected $fillable=[
        'image',
        'Sports_id',
        'seasons_id',
    ];
    public function sport(){
        return $this->belongsTo(sport::class,'Sports_id');
    }
    public function season(){
        return $this->belongsTo(seasone::class,'seasons_id');
    }
}
