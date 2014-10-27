<?php
class TablesController extends BaseController {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Default Home Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | You may wish to use controllers instead of, or in addition to, Closure
	 * | based routes. That's great! Here is an example controller method to
	 * | get you started. To route to this controller, just add the route:
	 * |
	 * |	Route::get('/', 'HomeController@showWelcome');
	 * |
	 */
	public function listdata() {
		$rows = DB::table (Route::input('table_name'))->count();//->where('serial_number',"==",Route::input('serial_number'))->count();
		
		if (Input::get ( "jtSorting" )) {
			$search = explode ( " ", Input::get ( "jtSorting" ) );
			$data = DB::table (Route::input('table_name'))->skip ( Input::get ( "jtStartIndex" ) )->take ( Input::get ( "jtPageSize" ) )->orderBy ( $search [0], $search [1] )->get ();
		} else {
			$data = DB::table (Route::input('table_name'))->skip ( Input::get ( "jtStartIndex" ) )->take ( Input::get ( "jtPageSize" ) )->get ();
		}
		
		//$data = DB::table (Route::input('table_name'))->get();
		return Response::json ( array (
				"Result" => "OK",
				"TotalRecordCount" => $rows,
				"Records" => $data
		) );
	}
}

