<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $fillable=['uuid',	'name',	'job_type',	'work',	'image'	,'Sports_id'];
    public function sport(){
        return $this->belongsTo(sport::class,'Sports_id');
    }
}
