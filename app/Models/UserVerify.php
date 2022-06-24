<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
    use HasFactory;

    public $table = 'users_verify';

    public $fillable = [
        'user_id',
        'token',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
