<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $fillable = [
        'video',
        'cover',
        'title',
        'about',
        'type',
        'monetize',
        'status',
        'license',
        'lang',
        'cast',
        'views',
        'likes',
        'dislikes',
        'user_id'
    ];

    public function Owner()
    {
        return $this->belongsTo(User::class);
    }

    public function Channels()
    {
        return $this->belongsToMany(Channel::class);
    }

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function Histories()
    {
        return $this->belongsToMany(User::class, 'histories', 'video_id', 'user_id')->withTimestamps();
    }

    public function Comments()
    {
        return $this->belongsToMany(User::class, 'comments', 'video_id', 'user_id')->withTimestamps();
    }

    public function Playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}
