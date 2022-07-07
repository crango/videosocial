<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelVideo extends Model
{
    use HasFactory;

    protected $table = 'channel_video';

    protected $fillable = [
        'channel_id',
        'video_id'
    ];
}
