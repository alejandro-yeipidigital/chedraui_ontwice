<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoredQuery extends Model
{
    protected $fillable = ['title', 'description', 'query'];
}
