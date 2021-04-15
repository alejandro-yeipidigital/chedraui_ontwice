<?php

namespace App\Repositories;

use App\Models\{Store};

class StoreRepository 
{
    /**
     * Get all stores
     */
    public function all ()
    {
        return Store::all();
    }
}