<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogDownloadController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	    $this->middleware('auth:admin');
	    $this->middleware(function ($request, $next) {
	                                    return (\Auth::user()->cannot('accessLogs', \Auth::user())) ? redirect('/admin/home') : $next($request);
	                                });
	}

	/**
	 * Return view with all stored logs
	 * @return View
	 */
    public function index(){
    	// Obtain the files in the logs folder
    	$filesInFolder = \File::files('logs');     
	    
	    foreach($filesInFolder as $path) { 
	          $basename 	= pathinfo($path);
	          $logs[] 		= $basename['basename'];
	     }

    	return view('admin.logs_download.index')->with(compact(['logs']));
    }
}
