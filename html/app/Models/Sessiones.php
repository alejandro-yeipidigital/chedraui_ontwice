<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessiones extends Model
{
    protected $table = 'sessions';

    protected $fillable = ['user_id'];
}
