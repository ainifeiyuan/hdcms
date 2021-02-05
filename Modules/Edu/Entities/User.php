<?php

namespace Modules\Edu\Entities;

use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Model;

class User extends ModelsUser
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'edu_user_video')
            ->orderBy('edu_user_video.created_at', 'desc')
            ->withPivot(['created_at', 'updated_at'])
            ->withTimestamps();
    }

    public function signs()
    {
        return $this->hasMany(Sign::class);
    }

    public function signInfo()
    {
        return $this->hasOne(SignTotal::class, 'user_id');
    }

    public function FavoriteLessons()
    {
        return $this->morphedByMany(Lesson::class, 'favorite', 'favorite');
    }

    public function FavoriteVideos()
    {
        return $this->morphedByMany(Video::class, 'favorite', 'favorite');
    }

    public function FavoriteTopic()
    {
        return $this->morphedByMany(Topic::class, 'favorite', 'favorite');
    }

    public function duration()
    {
        return $this->hasOne(Duration::class);
    }
}
