<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array <int, string>
     */
    protected $fillable = [
        'avatar',
        'name',
        'lastname',
        'email',
        'is_email_verified',
        'password',
        'phone',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'zip',
        'birthdate',
        'bio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function getCountry()
    {
        return $this->belongsTo(Country::class);
    }

    function getState()
    {
        return $this->belongsTo(State::class);
    }

    function getCity()
    {
        return $this->belongsTo(City::class);
    }

    public function Channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function Videos()
    {
        return $this->hasMany(Video::class);
    }

    public function Subscriptions()
    {
        return $this->belongsToMany(Channel::class, 'subscriptions', 'user_id', 'channel_id')->withTimestamps();
    }

    public function Histories()
    {
        return $this->belongsToMany(Video::class, 'histories', 'user_id', 'video_id')->withTimestamps();
    }

    public function Comments()
    {
        return $this->belongsToMany(Video::class, 'comments', 'user_id', 'video_id')->withTimestamps();
    }
}
