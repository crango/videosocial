<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'channel_id',
        'status'
    ];

    public function Users()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'channel_id', 'user_id');
    }
}
