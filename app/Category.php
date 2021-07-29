<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function articols(): HasMany
    {
        return $this->hasMany(Articol::class);
    }
}
