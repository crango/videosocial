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
        'dislikes'
    ];

    public function channel()
    {
        return $this->belongsToMany(Channel::class, 'channel_video');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_video');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_video');
    }

    public function histories()
    {
        return $this->belongsToMany(History::class, 'histories');
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'comments');
    }
}
