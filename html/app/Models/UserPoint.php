<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    protected $fillable = ['temporality_id', 'user_id', 'validated_points', 'pending_points', 'winner'];
    /**
    * @return 
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
