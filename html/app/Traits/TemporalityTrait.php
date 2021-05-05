<?php

namespace App\Traits;

use App\Models\Temporality;
use Carbon\Carbon;

/**
* Trait destinado para manejo de archivos en todo el sistema
*/
trait TemporalityTrait 
{
    /**
    * @return 
    */
    public function activeTemporality()
    {
        $now        = Carbon::createFromFormat("Y-m-d H:i:s", Carbon::now())->toDateTimeString();
        $response   = Temporality::select('id', 'name')
                        ->where('start', '<=', $now)
                        ->where('end', '>', $now)
                        ->first();

        return $response;
    }
}
