<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Pivot\Like;

trait Likable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|mixed
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function like(User $user = null)
    {
        /** @var User $user */
        $user = $user ?? auth()->user();

        if ($this->likes()->where(['user_id' => $user->id])->exists()) {
            throw new \Exception('You already like this!');
        }

        $this->likes()->create(['user_id' => $user->id]);
    }

    public function unlike(User $user = null)
    {
        /** @var User $user */
        $user = $user ?? auth()->user();

        $this->likes()->where(['user_id' => $user->id])->delete();
    }

    public function getIsLikedAttribute()
    {
        if (auth()->check()) {
            return $this->likes()->where(['user_id' => auth()->id()])->exists();
        }

        return false;
    }
}