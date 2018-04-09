<?php

namespace App\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Like extends Pivot
{
    protected $table = 'likes';
    public $timestamps = false;

    public function likable()
    {
        return $this->morphTo();
    }
}
