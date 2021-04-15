<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    protected $fillable = [
        'participation_id',
        'life',
        'points',
        'status_game',
        'status'
    ];
}
