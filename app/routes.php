<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('templates.main');
});

//Tables Show Route - This route show the Jtable 
Route::get('/{table_name}/{serial_number}', array('as'=>'show_table_route', function ($table_name,$serial_number){
	$data = ['table_name' =>$table_name,'serial_number' => $serial_number];
	return View::make('tables.'.$table_name,$data);
}));//->where('serial_number','plinio');

//Tables List Route - This route list data from table and populates Jtable
Route::any('tables/{table_name}/list/{serial_number}', array('as' => 'tables_data_list','uses'=> 'TablesController@listdata'));//->where('serial_number','plinio');

//Import Data to General Info Table Route
Route::any('importing/general_info/{serial_number}', array('as' => 'importing_data_to_general_info_table','uses'=> 'ImportingController@importGeneralInfo'));

//Import Data to Communication Event History Table  Route
Route::any('importing/communication_event_history/{serial_number}', array('as' => 'importing_data_to_communication_event_history_table','uses'=> 'ImportingController@importCommunicationHistory'));



//Teste