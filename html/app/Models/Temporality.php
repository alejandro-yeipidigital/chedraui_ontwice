<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporality extends Model
{
    protected $fillable = ["start_at", "finish_at", "name"];
}
