<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Tag extends Model
{
    public function articols(): BelongsToMany
    {
        return $this->belongsToMany(Articol::class);
    }

}
