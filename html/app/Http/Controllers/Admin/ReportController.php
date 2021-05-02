<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\{Temporality, Participation};
use App\Traits\{CsvExportTrait};
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use CsvExportTrait;

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
            $participaciones_fases[$contador]['participaciones'] = Participation::join('users', 'users.id', '=', 'participations.user_id')
                                                                                    ->join('temporalities', 'temporalities.id', '=', 'participations.temporality_id')
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
                                                                                            'participations.store AS store',
                                                                                            'participations.pay AS pay',
                                                                                            'participations.region AS region',
                                                                                            'participations.total_ticket AS total',
                                                                                            'participations.reason AS reason',
                                                                                            'participations.other_products AS other_products',
                                                                                            'participations.created_at AS date'
                                                                                        ])
                                                                                        ->toArray();

            $contador++;
        }

        // dd($temporalidades);
        
        return view('admin.report.index', compact([
                                                    'participaciones_fases',
                                                    'temporalidades'
                                                ]));
    }
    
    /**
     * Exports query results to a CSV file
     * 
     * @param Request $request
     * @return CSV
     */
    public function exportQueryResultCsv (Request $request)
    {
        // Obtain temporality name
        $temporality = Temporality::find($request->temporality_id);
        
        // Create params required to csv export
        $name       = 'Reporte_Tickets_' . $temporality->name . '_' .  \Str::slug(Carbon::now(), '-');
        $location   = '/reports_exports';
        $data       = $this->getQuery($request->temporality_id);

        return $this->exportToCsv($name, $location, $data);
    }


    /**
     * Get Query to be converted into CSV
     * 
     * @param int $temporality_id
     * @return array 
     */
    public function getQuery (int $temporality_id) : array
    {
        
        $participations = Participation::join('users', 'users.id', '=', 'participations.user_id') 
                            ->join('temporalities', 'temporalities.id', '=', 'participations.temporality_id')
                            ->leftJoin('stores', 'stores.id', '=', 'participations.store')
                            ->where('participations.temporality_id', '=', $temporality_id)
                            ->get([
                                    'participations.id AS Ticket_Id',
                                    'temporalities.name AS Fase', 
                                    'users.name AS Nombre',
                                    'users.middle_name AS Apellido_Paterno',
                                    'users.last_name AS Apellido_Materno', 
                                    'users.telephone AS Telefono', 
                                    'users.email AS Correo', 
                                    'participations.validation AS validacion',
                                    'participations.ticket_code AS Folio',
                                    'participations.main_product AS Producto_Principal',
                                    'participations.region AS Region',
                                    'stores.store AS Proveedor',
                                    'participations.pay AS Forma_De_Pago',
                                    'participations.total_ticket AS Monto_Total',
                                    'participations.other_products AS Otros_Productos',
                                    'participations.reason AS Razon_de_Rechazo',
                                    'participations.created_at AS Fecha_de_Registro'
                                ])
                                ->toArray();

        // Go over each participation to update ticket validation status id for a text
        $updated_participations = collect($participations)->map(function ($participation) {
            // dd($participation);
            // Update validation text based on status
            switch ($participation['validacion']) {
                case 1: // 1 = pendiente, 
                    $participation['validacion'] = 'Pendiente';
                    break;
                case 2: // 2 = validado, 
                    $participation['validacion'] = 'Validado';
                    break;
                case 3: // 3 = rechazado
                    $participation['validacion'] = 'Rechazado';
                    break;
            }

            return $participation;
        })
        ->toArray();

        return $updated_participations;
    }
}

