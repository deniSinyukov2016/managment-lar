<?php

namespace App\Models\Traits;

use App\Models\Reply;

trait Repliable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|mixed
     */
    public function replies()
    {
        return $this->morphMany(Reply::class, 'repliable');
    }
}