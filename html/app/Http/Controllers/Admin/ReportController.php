<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Tablas
use App\User;
use App\Models\Participation;
use App\Models\Temporality;

class ReportController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Report
     * 
     * @param none
     * @return View admin.report.index
     */
    
    public function index ()
    {
        // Obtener todas las temporalidades
        $temporalidades = Temporality::where('temporalities.finalized', '==', '0')
                                ->get([
                                        'id',
                                        'name AS temporality'
                                    ]);

        // Definir arreglo que participaciones por fase
        $participaciones_fases = [];
        $contador = 0;

        // Llenar arreglo de participaciones por cada fase
        foreach ($temporalidades as $temporalidad) {
            $participaciones_fases[$contador]['participaciones']        = Participation::join('users', 'users.id', '=', 'participations.user_id')
                                        ->join('temporalities', 'temporalities.id', '=', 'participations.temporality_id')
                                        ->leftJoin('stores', 'stores.id', '=', 'participations.store')
                                        ->where('participations.temporality_id', '=', $temporalidad['id'])
                                        ->get([
                                                'participations.id AS id',
                                                'temporalities.name AS temporality', 
                                                'users.name AS name',
                                                'users.middle_name AS middle_name',
                                                'users.last_name AS last_name', 
                                                'users.telephone AS telephone', 
                                                'users.email AS email', 
                                                'participations.validation AS validation',
                                                'participations.ticket_code AS folio',
                                                'participations.main_product AS product',
                                                'stores.store AS store',
                                                'participations.pay AS pay',
                                                'participations.total_ticket AS total',
                                                'participations.reason AS reason',
                                                'participations.other_products AS other_products',
                                                'participations.created_at AS date'
                                            ])
                                            ->toArray();

            $contador++;
        }
        
        return view('admin.report.index', compact([
                                                    'participaciones_fases',
                                                    'temporalidades'
                                                ]));
    }   
}

