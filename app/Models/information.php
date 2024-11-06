<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class information extends Model
{
    use HasFactory;
    protected $fillable=[
        'uuid',
        'title',
        'content',
        'image',
        'reads',
        'type',
        'statistic_id',
    ];
    public function statistic(){
        return $this->belongsTo(statistic::class,'statistic_id');
    }
}
