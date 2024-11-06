<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class standing extends Model
{
    use HasFactory;
    protected $fillable=['uuid',	'win',	'lose',	'draw',	'+/-',	'point',	'play',	'Clubs_id',	'seasons_id','for_him','attic'	];
    public function club(){
        return $this->belongsTo(club::class,'Clubs_id');
    }

    public function seasons(){
        return $this->belongsTo(seasone::class,'seasons_id');
    }
}
