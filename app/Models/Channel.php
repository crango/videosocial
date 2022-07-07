<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

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
        'subscriptions'
    ];

    public function Owner()
    {
        return $this->belongsTo(User::class);
    }

    function Subscriptions()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'channel_id', 'user_id');
    }

    public function Videos()
    {
        return $this->belongsToMany(Video::class);
    }
}
