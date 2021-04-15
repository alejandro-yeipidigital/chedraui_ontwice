<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Log};
use Illuminate\Http\Request;

class LogController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
    * Return all the logs
    * @param NULL
    * @return View
    */
    public function index()
    {
    	$logs = Log::join('status_logs', 'status_logs.id', '=', 'logs.status_id')
    				->select(
    						'logs.id AS id', 
    						'logs.status_id AS status_id', 
    						'logs.message AS message', 
    						'logs.verified AS verified',
    						'logs.created_at AS created_at', 
    						'logs.updated_at AS updated_at', 
    						'status_logs.status AS status'
    					)
                    ->orderBy('logs.created_at', 'DESC')
    				->get();

    	return view('admin.logs.index')->with(compact(['logs']));
    }

    /**
     * Update verified field for the requested log
     * @param Request $request
     * @return redirect
     */
    public function verifyIncidence(Request $request)
    {
    	$log 			= Log::find($request->log_id);
    	$log->verified 	= 1;
    	$log->save(); 

    	return redirect()->back();
    }
}
