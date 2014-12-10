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
	 * |	Route::get('/', 'TablesController@listdata');
	 * |
	 */
	public function listdata() {
		//Recoveres the ID of the SubDrive for a given Serial Number
		$subdrive_id = null;		
		$subdrive_first_row = DB::table('subdrives')->where('serial_number',Route::input('serial_number'))->first();
		if($subdrive_first_row){
			$subdrive_id = $subdrive_first_row->id;
		}		
		//$subdrive_id = 1;
		$rows = DB::table (Route::input('table_name'))->where('subdrive_id',$subdrive_id)->count();
		
		if (Input::get ( "jtSorting" )) {
			$search = explode ( " ", Input::get ( "jtSorting" ) );
			if(Input::get ( "jtPageSize" ))
				$data = DB::table (Route::input('table_name'))->where('subdrive_id',$subdrive_id)->skip ( Input::get ( "jtStartIndex" ) )->take ( Input::get ( "jtPageSize" ) )->orderBy ( $search [0], $search [1] )->get ();
			else
				$data = DB::table (Route::input('table_name'))->where('subdrive_id',$subdrive_id)->orderBy ( $search [0], $search [1] )->get ();
		} else {
			if(Input::get ( "jtPageSize" ))
				$data = DB::table (Route::input('table_name'))->where('subdrive_id',$subdrive_id)->skip ( Input::get ( "jtStartIndex" ) )->take ( Input::get ( "jtPageSize" ) )->get ();
			else
				$data = DB::table (Route::input('table_name'))->where('subdrive_id',$subdrive_id)->get ();
		}
		
		//$data = DB::table (Route::input('table_name'))->get();
		return Response::json ( array (
				"Result" => "OK",
				"TotalRecordCount" => $rows,
				"Records" => $data
		) );
	}
}

