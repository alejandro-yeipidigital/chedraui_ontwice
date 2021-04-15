<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'role_id', 'active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
