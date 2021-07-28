<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Tag extends Model
{
    public function articol(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

}
