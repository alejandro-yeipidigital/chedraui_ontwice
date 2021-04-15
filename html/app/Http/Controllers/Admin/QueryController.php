<?php

namespace App\Http\Controllers\Admin;

use App\Exports\QueryResultExport;
use App\Http\Controllers\Controller;
use App\Models\{StoredQuery};
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class QueryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

        // Ejemplo de como ejecutar Policies de Manera Global a un Controlador
        $this->middleware(function ($request, $next) {
                                        return (\Auth::user()->cannot('accessQueries', \Auth::user())) ? redirect('/admin/home') : $next($request);
                                    });
    }

    /**
     * Devuelve la vista para el manejador de consultas visual
     * @return View
     */
    public function query_manager_index() 
    {
        // Get all tables from schema
        $tables = array_map('reset', \DB::select('SHOW TABLES'));

        // Get the stored queries
        $queries = StoredQuery::all();

        return view('admin.query_manager.index')->with(compact(["tables", "queries"]));
    }

    /**
     * Exports query results to a xlsx file
     * @param Request $request
     * @return Excel
     */
    public function exportQueryResultXlsx(Request $request)
    {
        return Excel::download(new QueryResultExport($request->export_query_xlsx), 'invoices.xlsx');
    }

    /**
     * Exports query results to a CSV file
     * @param Request $request
     * @return CSV
     */
    public function exportQueryResultCsv(Request $request)
    {
        // Obtains the query results
        $queryResult = \DB::select(urldecode($request->export_query_csv));
        $values = json_decode(json_encode($queryResult), true);

        // Gets the column headers name
        $keys[0] = array_keys($values[0]);

        // Create directory in Storage, clear if there are any files inside
        $directory = storage_path('app/public/query_exports');
        ( !\File::exists( $directory ) ) ? \File::makeDirectory( $directory, 0777, true ) : \File::cleanDirectory( $directory );

        // File name
        $fileName = 'query_' .  Str::slug(Carbon::now(), '-') . '.csv';

        // Open file
        $fp = fopen( $directory . '/' . $fileName , 'w');

        // Write column headers name
        foreach ($keys as $key ) {
            fputcsv($fp, $key);
        }

        // Write values
        foreach ($values as $fields) {
            fputcsv($fp, $fields);
        }

        // Close file
        fclose($fp);

        return response()->download($directory . '/' . $fileName);
    }

    /**
     * Recibe los mensajes de error del sistema y devuelve un mensaje claro al usuario
     * @param String: $mensaje_error
     * @return String: mensaje
     */
    public function error_handler( $mensaje_error )
    {
        if (strpos($mensaje_error, 'SQLSTATE[42S02]') !== false) {
            return 'La tabla no existe.';
        } elseif ( strpos($mensaje_error, 'SQLSTATE[42000]') !== false ) {
            return 'Error de sintaxis.';
        } elseif ( strpos($mensaje_error, 'SQLSTATE[42S22]') !== false ) {
            return 'La columna "' . explode("'", $mensaje_error)[1] . '" no existe.';
        }

        return 'Error al realizar la consulta.';
    }

    /**
     * Función que devuelve las columnas pertenecientes a la tabla seleccionada
     * @param String: $table
     * @return Array: columnas
     */
    public function get_columns( $table )
    {
        // Revisar si la tabla existe
        if (!\Schema::hasTable( $table )) {
            return false;
        }

        return \Schema::getColumnListing( $table );
    }

    /**
     * Generar consulta de acuerdo a las columas seleccionadas o *
     * @param String $columnas, String tabla
     * @return Array $respuesta
     */
    public function create_query( $columnas, $tabla) 
    {
        // Si se seleccionó *
        if ( strpos($columnas, 'select_all') !== false ) {
            return [
                        "query"         => 'SELECT * FROM ' . $tabla,
                        "select_all"    => true,
                        "columnas"      => \Schema::getColumnListing( $tabla )
                    ];
        } 
        
        return [
                    "query"         => 'SELECT ' . $columnas . ' FROM ' . $tabla,
                    "select_all"    => false
                ];
    }

    /**
     * Manipula los datos ingresados desde el manejador de consultas visual
     * para ejecutar la consulta solicitada
     * @param Request $request
     * @return resultado de Query
     */
    public function get_visual_query( Request $request )
    {
        // 1.0 Revisar si la tabla existe
        if (!\Schema::hasTable( $request->table )) {
            return 'false';
        }

        // 2.0 Concatenar nombres de los campos seleccionados
        $columnas = implode(",", $request->columns);
        
        // 3.0 Genera consulta de acuerdo a las columnas solicitadas
        $consulta = $this->create_query( $columnas, $request->table );

        if ( $consulta['select_all'] == false ) {
            $consulta['columnas'] = $request->columns;
        }
        
        // 4.0 Realizar consulta
        $resultado = $this->query_manager($consulta['query']);

        // 5.0 Genera arreglo con total de resultados y los resultados
        $respuesta = [
                        "total_resultados"  => count($resultado['resultado']),
                        "resultado"         => $resultado,
                        "columnas"          => $consulta['columnas']
                    ];

        return $respuesta;
    }

    /**
     * Defines which type of queries may be executed
     * @param String: $consulta
     * @return Boolean
     */
    public function selectOnly_handler( $consulta )
    {
        if ( strpos($consulta, 'drop database') !== false ) {
            return false;
        } 

        /*if (strpos($consulta, 'insert into') !== false) {
            return false;
        } elseif ( strpos($consulta, 'delete from') !== false ) {
            return false;
        } else*/
        // if ( strpos($consulta, 'alter table') !== false ) {
        //     return false;
        // } 
        /*elseif ( strpos($consulta, 'drop table') !== false ) {
            return false;
        }*/
         
        // elseif ( strpos($consulta, 'update') !== false ) {
        //     return false;
        // }

        return true;
    }

    /**
     * Manipula los datos ingresados desde el manejador de consultas manual
     * para ejecutar la consulta solicitada
     * @param Request $request
     * @return resultado de Query
     */
    public function get_manual_query( Request $request )
    {
        // Remover encode a la consulta enviada por el usuario
        $consulta =  strtolower( urldecode($request->encode_query) );

        // Validar que sólo sea consulta de información
        $selectOnly = $this->selectOnly_handler( $consulta );

        if ( !$selectOnly ) {
            return [ 
                        "resultado" => 'Sólo se puede realizar consulta de información.',
                        "success"   => false
                    ];
        }

        // Ejecuta la consulta
        $respuesta = $this->query_manager( $consulta );

        if ( $respuesta['success'] == true ) {
            $respuesta['total_resultados'] = count( $respuesta['resultado'] );
        }

        return $respuesta;
    }

    /**
     * Manejador de queries, encargado de ejecutar la consulta
     * devuelve excepciones en caso de ser necesario
     * @param String: query
     * @return Resultado de Query
     */
    public function query_manager( $consulta )
    {
        try {
            $query = DB::select( $consulta );
        } catch( \PDOException $p ) {
            return [ 
                        "resultado" => $this->error_handler($p),
                        "success"   => false
                    ];
        } catch( \Exception $e ) {
            return [ 
                        "resultado" => $e->getMessage(),
                        "success"   => false
                    ];

        } 

        return [ 
                    "resultado" => $query,
                    "success"   => true
                ];
    }

    /**
     * Store query for futher use
     *
     *
     */
    public function storeQuery(Request $request)
    {
        // Validate

        $query              = new StoredQuery;
        $query->title       = $request->title;
        $query->description = $request->description;
        $query->query       = $request->encode_storing_query;
        $query->save();

        return 1;
    }
}
