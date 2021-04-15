<?php

namespace App\Repositories;

use App\Models\{TemporalityPoint, Temporality};

class TemporalityPointsRepository 
{
    /**
     * Finds a user inside the ranking
     * 
     * @param int $temporality_id, 
     * @param int $user_id
     * @return TemporalityPoint $temporality_points
     */
    public function findRanking(int $temporality_id, int $user_id) 
    {
        return TemporalityPoint::whereTemporalityId($temporality_id)
                                    ->whereUserId($user_id)
                                    ->first();
    }

    /**
     * Creates a register in ranking
     * 
     * @param int $temporality_id, int $user_id, int $points
     * @return TemporalityPoint $register
     */
    public function createRanking(int $temporality_id, int $user_id, int $points) 
    {
        $ranking = new TemporalityPoint;
        $ranking->temporality_id    = $temporality_id;
        $ranking->user_id       = $user_id;
        $ranking->points            = $points;
        $ranking->save();
        
        return $ranking;
    }

    /**
     * Updates user points in temporality
     * 
     * @param int $temporality_id, int $user_id, int $points
     * @return TemporalityPoint $temporality_points
     */
    public function updateRanking(int $temporality_id, int $user_id, int $points) 
    {
        $ranking_id = $this->findRanking($temporality_id, $user_id);
        $ranking_id = $ranking_id->id;
        info($ranking_id);

        return TemporalityPoint::find($ranking_id)->increment('points', $points);
    }

    /**
     * Creates or Updates a register in temporality points
     * 
     * @param int $temporality_id, int $user_id, int $points
     * @return TemporalityPoint $temporality_points
     */
    public function createOrUpdateRanking(int $temporality_id, int $user_id, int $points) 
    {
        $ranking = $this->findRanking($temporality_id, $user_id);

        return ($ranking) 
            ? $this->updateRanking($temporality_id, $user_id, $points)
            : $this->createRanking($temporality_id, $user_id, $points);
    }

    /**
     * Obtains a basic ranking by a specific temporality
     * This ranking is showed for users
     * 
     * @param int $temporality_id
     * @return $temporality_ranking
     */
    public function getRankingByTemporality(int $temporality_id) 
    { 
        return TemporalityPoint::join('users', 'temporality_points.user_id', '=', 'users.id')
                            ->whereTemporalityId($temporality_id)
                            ->where('users.blocked', '<>', 1)
                            ->orderBy('temporality_points.points', 'desc')
                            ->take(100)
                            ->get([
                                    'users.name AS user_name',
                                    'users.middle_name AS middle_name',
                                    'users.last_name AS last_name'
                                ]);
    }

    /**
     * 
     * 
     * @param int $temporality_id, int $whatsapp_id, int $points
     * @return $temporality_ranking_report
     */
    public function getRankingByTemporalityReport(int $temporality_id) 
    {
        return TemporalityPoint::join('users', 'temporality_points.user_id', '=', 'users.id')
                            ->whereTemporalityId($temporality_id)
                            ->where('users.blocked', '<>', 1)
                            ->orderBy('temporality_points.points', 'desc')
                            ->take(200)
                            ->get([
                                    'temporality_points.points AS Puntos',
                                    'users.id AS user_id',
                                    'users.name AS Nombre',
                                    'users.middle_name AS Apellido_Paterno',
                                    'users.last_name AS Apellido_Materno',
                                    'users.rut AS RUT',
                                    'users.telephone AS Telefono_Contacto',
                                    'users.wa_number AS Whatsapp',
                                    'users.email AS Correo_Electronico'
                                ]);
    }

    /**
     * Retrive user points in each temporality to be displayed in admin
     * 
     * @param int $user_id
     * @param int $promotion_id
     * @return array $temporalitiees_points
     */
    public function getUserPointsInPromotion(int $user_id, int $promotion_id) 
    {
        $temporalities = Temporality::wherePromotionId($promotion_id)
                                        ->whereFinalized(0)
                                        ->get(['id', 'name']);
                                        
        foreach ($temporalities as $temporality) {
            $points = TemporalityPoint::whereTemporalityId($temporality->id)
                                        ->whereUserId($user_id)
                                        ->get(['points'])
                                        ->pluck('points');
            
            $temporality->points = $points[0] ??  '-';
        }
        return $temporalities;
    }

    /**
     * Delete user's points
     * 
     * @param int $user_id
     * @return void
     */
    public function deleteUserPoints(int $user_id) : void
    {
        TemporalityPoint::whereUserId($user_id)->delete();
    }
}