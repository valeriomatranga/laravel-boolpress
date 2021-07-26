<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articols()
    {
        return $this->hasMany(Articol::class);
    }
}
