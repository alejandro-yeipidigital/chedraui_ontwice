<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = ['user_id',
     'temporality_id',
     'ticket',
     'validation',
     'total_points',
     'ticket_code',
     'free',
     'main_product',
     'store',
     'pay',
     'total_ticket',
     'reason',
     'other_products'
    ];

    /**
    * @return 
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * @return 
    */
    public function temporality()
    {
        return $this->belongsTo(Temporality::class);
    }
}
