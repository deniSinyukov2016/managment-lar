<?php

namespace App\Models;

use App\Models\Traits\Likable;
use App\Models\Traits\Repliable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int|null user_id
 * @property Collection likes
 * @property Collection replies
 * @property mixed status
 */
class Idea extends Model
{
    use Likable, Repliable;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            static::creating(function (self $idea) {
                $idea->user_id = auth()->id();
                $idea->status = 'NOT_WATCHED';
            });
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notWatched()
    {
        return $this->status === 'NOT_WATCHED';
    }

    public function watch()
    {
        $this->update(['status' => 'WATCHED']);
    }

    public function setStatusAttribute($value)
    {
        $statuses = array_keys(config('enums.ideas.statuses'));

        if (!in_array($value, $statuses)) {
            throw new \Exception('Incorrect idea status', 400);
        }

        $this->attributes['status'] = $value;
    }
}
