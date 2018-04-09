<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 */
class Reply extends Model
{
    protected $guarded = ['id'];

    public function repliable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCanUpdateAttribute()
    {
        return auth()->user()->is_admin || auth()->id() === $this->user_id;
    }

    public function getCanDeleteAttribute()
    {
        return $this->getCanUpdateAttribute();
    }
}
