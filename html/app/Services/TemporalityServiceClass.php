<?php

namespace App\Services;

use App\Repositories\{TemporalityRepository, TemporalityPointsRepository};
use Carbon\Carbon;

class TemporalityServiceClass 
{   
    protected $temporalityPointsRepository;

    public function __construct() {
       $this->temporalityPointsRepository = new TemporalityPointsRepository;
    }

    /**
     * Get Current Temporalty based on given country
     * @param int $promotion_id
     * @return $temporality
     */
    public function getCurrentTemporality(int $promotion_id) {
        $temporalities_repository = new TemporalityRepository;
        $temporalities = $temporalities_repository->getTemporalities($promotion_id);

        
        foreach ($temporalities as $temporality) {
            $start    = Carbon::parse($temporality->start);
            $end      = Carbon::parse($temporality->end);
            
            if (Carbon::now()->between($start, $end)) {
                return $temporality;
            }
        }
        return null;
    }

    /**
     * 
     */
    public function getRanking(int $promotion_id) {
        // Obtain current temporality
        $current = $this->getCurrentTemporality($promotion_id);
        $current = $current->id;

        // Get Promotion Temporalities
        $temporalities_repository = new TemporalityRepository;
        $temporalities = $temporalities_repository->getPlayedTemporalities($promotion_id, $current);

        // Buld Ranking
        $position = 0;
        $ranking = [];
        foreach ($temporalities as $temporality) {
            // Add Temporality Name
            $ranking[$position]['temporality_name'] = $temporality->name;

            // Verify if is the current temporality
            ($temporality->id == $current)
            ? $ranking[$position]['active'] = 1
            : $ranking[$position]['active'] = 0;

            // Add Ranking
            $ranking_position = 0;

            $users = $this->temporalityPointsRepository->getRankingByTemporality($temporality->id);

            foreach ($users as $user) {
                $ranking[$position]['ranking'][$ranking_position] = $user->user_name . ' ' . $user->middle_name;
                $ranking_position++;
            }

            $position++;
        }

        return $ranking;
    }
}