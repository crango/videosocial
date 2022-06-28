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
}
