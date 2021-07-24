<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articol extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
    ];
}
