<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property User creator
 * @property Project project
 * @property string name
 * @property bool is_close
 * @property int creator_id
 */
class Meeting extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date_time'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $meeting) {
            $meeting->is_close = false;

            if (auth()->check()) {
                $meeting->creator_id = auth()->id();
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
