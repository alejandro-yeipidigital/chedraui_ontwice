<?php

namespace App\Repositories;

use App\Models\{Temporality};

class TemporalityRepository 
{
    /**
     * Get Temporalities by Country Id
     * @param int $promotion_id
     * @return $temporalities
     */
    public function getTemporalities(int $promotion_id) {
        return Temporality::wherePromotionId($promotion_id)->get();
    }

    /**
     * Get Temporalities by Country Id
     * @param int $promotion_id
     * @return $temporalities
     */
    public function getPlayedTemporalities(int $promotion_id, int $current_temporality_id) {
        return Temporality::wherePromotionId($promotion_id)
                            ->where('id', '<=', $current_temporality_id)
                            ->whereFinalized(0)
                            ->get();
    }
}