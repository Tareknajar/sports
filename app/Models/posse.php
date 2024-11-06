<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posse extends Model
{
    use HasFactory;
    protected $fillable=[

        'uuid',
        'name',
        'statr_tear',
        'image',
    ];
}
