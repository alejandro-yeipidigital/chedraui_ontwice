<?php

namespace App;

use App\Models\Participation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'middle_name',
        'last_name',
        'email',
        'telephone',
        'birthday',
        'size',
        'street',
        'number_int',
        'number_ext',
        'zip_code',
        'neighborhood',
        'municipality',
        'state',
        'total_info',
        'fb_email',
        'avatar',
        'register_type',
        'active',
        'password',
        'observations'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accesors
    |--------------------------------------------------------------------------
    */
    public function getFullNameAttribute() {
        return "{$this->name} {$this->middle_name} {$this->last_name}";
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function participations()
    {
        return $this->hasMany('App\Models\Participation');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return false;
    }
}
