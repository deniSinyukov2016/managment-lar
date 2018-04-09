<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @property int id
 * @property bool is_admin
 * @property bool password
 * @property string avatar
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['confirmed' => 'boolean'];

    public function addUser(array $user)
    {
        if (!$this->exists || !$this->isAdmin()) {
            throw new HttpException('You is not admin!', 500);
        }

        return static::query()->create($user);
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function createdProjects()
    {
        return $this->hasMany(Project::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function technologies()
    {
        return $this->morphToMany(Technology::class, 'technologgable');
    }

    public function attachProjects(int $paginate = 10)
    {
        if ($this->isAdmin()) {
            return Project::query()->withCount('comments')->paginate($paginate);
        }

        return  $this->projects()->withCount('comments')->paginate($paginate);
    }

    public function routeNotificationForSlack()
    {
        return config('services.slack.webhook');
    }

    public function getAvatarUrlAttribute()
    {
        return url('storage/avatars/' . $this->avatar);
    }
}
