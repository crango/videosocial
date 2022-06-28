<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $table = 'playlists';
    protected $fillable = ['name', 'description', 'status'];

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'playlist_video');
    }
}
