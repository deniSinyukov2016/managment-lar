<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technology extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function projects()
    {
        return $this->morphedByMany(Project::class, 'technologgable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'technologgable');
    }
}
