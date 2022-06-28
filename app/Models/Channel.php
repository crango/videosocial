<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    protected $fillable = [
        'title',
        'about',
        'image',
        'cover',
        'fb',
        'tw',
        'in',
        'status',
        'user_id',
        'suscribers'
    ];

    function Subscribers()
    {
        return $this->belongsToMany(User::class, 'subscribers');
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'channel_video');
    }
}
