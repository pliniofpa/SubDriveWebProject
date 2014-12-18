<?php
/*
 * Author: Plínio Andrade <pandrade@fele.com>
 * Company: Franklin Electric
 * Date: 10/20/2014
 * Application: SubDrive Web System
 */

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

Route::get('/', array('as' => 'main',function()
{
	if(Auth::check()){
		return Redirect::to('/dashboard');
	}else{
		return Redirect::to('/login');
	}
	
}));
Route::get('/login', array('as' => 'login',function()
{
	return View::make('login');
}));
Route::get('/register', array('as' => 'register',function()
{
	return View::make('register');
}));

Route::post('/register', array('as' => 'register_post','uses'=> 'HomeController@userRegister'));

Route::post('/login', array('as' => 'login_post','uses'=> 'HomeController@userLogin'));

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

//Import Data to Config Event History Table  Route
Route::any('importing/config_event_history/{serial_number}', array('as' => 'importing_data_to_config_event_history_table','uses'=> 'ImportingController@importConfigHistory'));

//Import Data to Current Limit Event History Table  Route
Route::any('importing/current_limit_event_history/{serial_number}', array('as' => 'importing_data_to_communication_event_history_table','uses'=> 'ImportingController@importCurrentLimitHistory'));

//Import Data to Fault History Table  Route
Route::any('importing/fault_history/{serial_number}', array('as' => 'importing_data_to_fault_history_table','uses'=> 'ImportingController@importFaultHistory'));

//Import Data to Motor On time Event History Table  Route
Route::any('importing/motor_on_time_event_history/{serial_number}', array('as' => 'importing_motor_on_time_event_history_table','uses'=> 'ImportingController@importMotorOnTimeHistory'));

//Import Data to Overload History Table  Route
Route::any('importing/overload_history/{serial_number}', array('as' => 'importing_overload_history_table','uses'=> 'ImportingController@importOverloadHistory'));

//Import Data to Power On Time Event History Table  Route
Route::any('importing/power_on_time_event_history/{serial_number}', array('as' => 'importing_power_on_time_event_history_table','uses'=> 'ImportingController@importPowerOnTimeHistory'));

//Import Data to Reset Event History Table  Route
Route::any('importing/reset_event_history/{serial_number}', array('as' => 'importing_reset_event_history_table','uses'=> 'ImportingController@importResetHistory'));

//Import Data to Temperature Event History Table  Route
Route::any('importing/temperature_event_history/{serial_number}', array('as' => 'importing_temperature_event_history_table','uses'=> 'ImportingController@importTemperatureHistory'));
