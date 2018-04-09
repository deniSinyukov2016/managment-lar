<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property Collection technologies
 */
class Project extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function creator()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /* Return users which anchored to projects*/
    public function getAttachedUsers()
    {
        return $this->users()->get();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsSortNew()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function dateEnd()
    {
        return Carbon::parse($this->getOriginal('date_end'))->format('F j, Y');
    }

    public function technologies()
    {
        return $this->morphToMany(Technology::class, 'technologgable');
    }
}
