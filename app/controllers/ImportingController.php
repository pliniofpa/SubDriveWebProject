<?php
/*
 * Author: Plínio Andrade <pandrade@fele.com>
 * Company: Franklin Electric
 * Date: 10/20/2014
 * Application: SubDrive Web System
 */
class ImportingController extends BaseController {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Importing Data Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | You may wish to use controllers instead of, or in addition to, Closure
	 * | based routes. That's great! Here is an example controller method to
	 * | get you started. To route to this controller, just add the route:
	 * |
	 * |	Route::get('importing/table_name/{serial_number}', 'ImportingController@importTableName');
	 * |
	 */
	
	// Convert an amount of Seconds to Days, Hours, and Minutes
	public static function converttoDHM($type = "total") {
		$return_array = array ();
		$timeOnSeconds = 0;
		
		if ($type == "total") {
			// Fields for On Time Total
			if (array_key_exists ( 'TTIMEMSB', Input::all () ) && array_key_exists ( 'TTIMELSB', Input::all () )) {
				$timeOnSeconds = ( double ) ((( int ) Input::get ( 'FEVENSTMSB' )) * 65536 + (( int ) Input::get ( 'FEVENSTLSB' )));
			}
		}
		
		if ($type == "this_cycle") {
			// Fields for On this Cycle Total Time
			if (array_key_exists ( 'CTTIMEMSB', Input::all () ) && array_key_exists ( 'CTTIMELSB', Input::all () )) {
				$timeOnSeconds = ( double ) ((( int ) Input::get ( 'CTTIMEMSB' )) * 65536 + (( int ) Input::get ( 'CTTIMELSB' )));
			}
		}
		
		$return_array [$type . "_on_days"] = $timeOnSeconds / 60 / 60 / 24;
		$return_array [$type . "_on_hours"] = (($timeOnSeconds % (24 * 60 * 60)) / 60 / 60);
		$return_array [$type . "_on_minutes"] = (($timeOnSeconds % (60 * 60)) / 60);
		
		return $return_array;
	}
	public static function motorPumpSize() {
		$return_array = array ();
		// Fields for Motor Size
		if (array_key_exists ( 'MTSW', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'MTSW' );
			switch ($tempValue) {
				case 1 :
					$return_array ['motor_size'] = "0.5 hp";
					break;
				case 2 :
					$return_array ['motor_size'] = "0.75 hp";
					break;
				case 3 :
					$return_array ['motor_size'] = "1.0 hp";
					break;
				case 4 :
					$return_array ['motor_size'] = "1.5 hp";
					break;
				case 5 :
					$return_array ['motor_size'] = "2.0 hp";
					break;
				case 6 :
					$return_array ['motor_size'] = "3.0 hp";
					break;
				default :
			}
		}
		// Fields for Pump Size
		if (array_key_exists ( 'PMSW', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'PMSW' );
			switch ($tempValue) {
				case 1 :
					$return_array ['pump_size'] = "0.5 hp";
					break;
				case 2 :
					$return_array ['pump_size'] = "0.75 hp";
					break;
				case 3 :
					$return_array ['pump_size'] = "1.0 hp";
					break;
				case 4 :
					$return_array ['pump_size'] = "1.5 hp";
					break;
				case 5 :
					$return_array ['pump_size'] = "2.0 hp";
					break;
				case 6 :
					$return_array ['pump_size'] = "3.0 hp";
					break;
				default :
			}
		}
		return $return_array;
	}
	
	// Controller of importing data to General Info Table
	public function importGeneralInfo() {
		$assoc_array = array ();
		// Fields for Drive Status
		if (array_key_exists ( 'CTFT', Input::all () ) && array_key_exists ( 'DVST', Input::all () )) {
			$fault_state = ( int ) Input::get ( 'CTFT' );
			$drive_state = ( int ) Input::get ( 'DVST' );
			if ($faultState > 0) {
				$assoc_array ['drive_status'] = "Fault";
			} else if ($drive_state == 0) {
				$assoc_array ['drive_status'] = "Drive Not Running";
			} else if ($drive_state == 1) {
				$assoc_array ['drive_status'] = "Drive Running";
			}
		}
		// Fields for FE Connect Dip Switch and Drive Type Dip Switch and Steady Flow
		if (array_key_exists ( 'DPSW', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'DPSW' );
			$assoc_array ['fe_connect_dip_switch'] = (($tempValue & 0x01) == 0x01) ? "On" : "Off";
			$assoc_array ['drive_type_dip_switch'] = (($tempValue & 0x02) == 0x02) ? "MonoDrive" : "SubDrive";
			$assoc_array ['steady_flow'] = (($tempValue & 0x08) == 0x08) ? "Enabled" : "Disabled";
		}
		// Fields for a set of configuration such as Hp/kW, Bump,Tank Size, Pot Mode
		if (array_key_exists ( 'FECN', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'FECN' );
			$assoc_array ['hp_kw'] = (($tempValue & 0x01) == 0x01) ? "kW" : "Hp";
			$assoc_array ['bump'] = (($tempValue & 0x02) == 0x02) ? "Disabled" : "Enabled";
			$assoc_array ['agressive_bump'] = (($tempValue & 0x04) == 0x04) ? "Enabled" : "Disabled";
			$assoc_array ['tank_size'] = (($tempValue & 0x08) == 0x08) ? "Large" : "Small";
			$assoc_array ['broken_pipe'] = (($tempValue & 0x10) == 0x10) ? "Disabled" : "Enabled";
			$assoc_array ['blurred_carrier'] = (($tempValue & 0x20) == 0x20) ? "Enabled" : "Disabled";
			$assoc_array ['constant_minimum_fan'] = (($tempValue & 0x40) == 0x40) ? "Enabled" : "Disabled";
			$assoc_array ['pot_mode'] = (($tempValue & 0x100) == 0x100) ? "Enabled" : "Disabled";
		}
		// Commented once the serial number is coming by SN parameter instead of S0-SN9 parameters
		// Fields for Serial Number
		/*
		 * $serial = null;
		 * for($i = 0; $i < 12; $i ++) {
		 * if ($i < 9) {
		 * $key = 'SN0' . (( string ) $i);
		 * } else {
		 * $key = 'SN' . (( string ) $i);
		 * }
		 * if (array_key_exists ( $key, Input::all () )) {
		 * if ($serial == null) {
		 * $serial = '';
		 * }
		 * $serial .= Input::get ( $key );
		 * }
		 * }
		 */
		// Fields for MCB SW
		if (array_key_exists ( 'MBS0', Input::all () ) && array_key_exists ( 'MBS1', Input::all () )) {
			$assoc_array ['mcb_sw_version'] = Input::get ( 'MBS0' ) . Input::get ( 'MBS1' );
		}
		// Fields for MCB SW
		if (array_key_exists ( 'DBS0', Input::all () ) && array_key_exists ( 'DBS1', Input::all () )) {
			$assoc_array ['mcb_sw_version'] = Input::get ( 'DBS0' ) . Input::get ( 'DBS1' );
		}
		// Motor and Pump Size
		$assoc_array += ImportingController::motorPumpSize ();
		// Direct associated fields
		$assoc_array += array (
				'input_voltage' => Input::get ( 'VIN1' ) == null ? null : ( float ) Input::get ( 'VIN1' ),
				'output_voltage_a' => Input::get ( 'VOTA' ) == null ? null : ( float ) Input::get ( 'VOTA' ),
				'output_voltage_b' => Input::get ( 'VOTB' ) == null ? null : ( float ) Input::get ( 'VOTB' ),
				'output_voltage_c' => Input::get ( 'VOTC' ) == null ? null : ( float ) Input::get ( 'VOTC' ),
				'output_current_a' => Input::get ( 'IOTA' ) == null ? null : ( float ) Input::get ( 'IOTA' ),
				'output_current_b' => Input::get ( 'IOTB' ) == null ? null : ( float ) Input::get ( 'IOTB' ),
				'output_current_c' => Input::get ( 'IOTC' ) == null ? null : ( float ) Input::get ( 'IOTC' ),
				'inverter_temperature' => Input::get ( 'ITMP' ) == null ? null : (( float ) Input::get ( 'ITMP' )) / 10,
				'pfc_temperature' => Input::get ( 'PTMP' ) == null ? null : (( float ) Input::get ( 'PTMP' )) / 10,
				'output_frequency' => Input::get ( 'FOUT' ) == null ? null : ( float ) Input::get ( 'FOUT' ),
				'maximum_frequency' => Input::get ( 'MXFQ' ) == null ? null : ( float ) Input::get ( 'MXFQ' ),
				'minimum_frequency' => Input::get ( 'MNFQ' ) == null ? null : ( float ) Input::get ( 'MNFQ' ),
				'demand' => Input::get ( 'DMND' ) == null ? null : ( float ) Input::get ( 'DMND' ),
				'serial_number' => Input::get ( 'SN' ),
				'underload_sense_value' => Input::get ( 'USNS' ) == null ? null : ( float ) Input::get ( 'USNS' ),
				'underload_hours' => Input::get ( 'UTHR' ) == null ? null : ( int ) Input::get ( 'UTHR' ),
				'underload_minutes' => Input::get ( 'UTHM' ) == null ? null : ( int ) Input::get ( 'UTHM' ),
				'underload_seconds' => Input::get ( 'UTHS' ) == null ? null : ( int ) Input::get ( 'UTHS' ),
				'language' => Input::get ( 'LANG' ),
				'package_id' => Input::get ( 'PKID' ),
				'model_number' => Input::get ( 'MDNR' ),
				'hardware_version' => Input::get ( 'HWVR' ) 
		);
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'general_info' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Communication Event History Table
	public function importCommunicationHistory() {
		$assoc_array = array ();
		
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ),
				'dwb_total_errors' => Input::get ( 'DWBTERRMSB' ) == null || Input::get ( 'DWBTERRLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'DWBTERRMSB' )) * 65536 + (( int ) Input::get ( 'DWBTERRLSB' ))),
				'dwb_errors_at_powerup' => Input::get ( 'DWBERRPMSB' ) == null || Input::get ( 'DWBERRPLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'DWBERRPMSB' )) * 65536 + (( int ) Input::get ( 'DWBERRPLSB' ))),
				'dwb_errors_on_this_cycle' => Input::get ( 'DWBERRCMSB' ) == null || Input::get ( 'DWBERRCLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'DWBERRCMSB' )) * 65536 + (( int ) Input::get ( 'DWBERRCLSB' ))),
				'exb_total_errors' => Input::get ( 'EXBTERRMSB' ) == null || Input::get ( 'EXBTERRLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'EXBTERRMSB' )) * 65536 + (( int ) Input::get ( 'EXBTERRLSB' ))),
				'exb_errors_at_powerup' => Input::get ( 'EXBERRPMSB' ) == null || Input::get ( 'EXBERRPLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'EXBERRPMSB' )) * 65536 + (( int ) Input::get ( 'EXBERRPLSB' ))),
				'exb_errors_on_this_cycle' => Input::get ( 'EXBERRCMSB' ) == null || Input::get ( 'EXBERRCLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'EXBERRCMSB' )) * 65536 + (( int ) Input::get ( 'EXBERRCLSB' ))),
				'mcb_total_errors' => Input::get ( 'MCBTERRMSB' ) == null || Input::get ( 'MCBTERRLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'MCBTERRMSB' )) * 65536 + (( int ) Input::get ( 'MCBTERRLSB' ))),
				'mcb_errors_at_powerup' => Input::get ( 'MCBERRPMSB' ) == null || Input::get ( 'MCBERRPLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'MCBERRPMSB' )) * 65536 + (( int ) Input::get ( 'MCBERRPLSB' ))),
				'mcb_errors_on_this_cycle' => Input::get ( 'MCBERRCMSB' ) == null || Input::get ( 'MCBERRCLSB' ) == null ? null : ( double ) ((( int ) Input::get ( 'MCBERRCMSB' )) * 65536 + (( int ) Input::get ( 'MCBERRCLSB' ))),
		);
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'communication_event_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Config Event History Table
	public function importConfigHistory() {
		$assoc_array = array ();
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
		
		// Fields for a set of configuration such as FE Connect, Drive Type, Steady Flow, Dev. config /*FaultEventInfo[4]*/
		if (array_key_exists ( 'CONFIG1', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'CONFIG1' );
			$assoc_array ['fe_connect'] = (($tempValue & 0x01) == 0x01) ? "On" : "Off";
			$assoc_array ['drive_type'] = (($tempValue & 0x02) == 0x02) ? "SubDrive" : "MonoDrive";
			$assoc_array ['steady_flow'] = (($tempValue & 0x08) == 0x08) ? "Enabled" : "Disabled";
			$assoc_array ['device_config'] = (($tempValue & 0x0C) == 0x0C) ? "1" : "0";
		}
		// Motor and Pump Size
		$assoc_array += ImportingController::motorPumpSize ();
		// Fields for a set of configuration such as Units Config., Bump Config., Agressive Bump, Tank Size, Broken Pipe, Blurred Carrier, ... /*FaultEventInfo[8]*/
		if (array_key_exists ( 'CONFIG2', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'CONFIG2' );
			$assoc_array ['units_config'] = (($tempValue & 0x01) == 0x01) ? "hp" : "kW";
			$assoc_array ['bump_configuration'] = (($tempValue & 0x02) == 0x02) ? "On" : "Off";
			$assoc_array ['agressive_bump'] = (($tempValue & 0x04) == 0x04) ? "Off" : "On";
			$assoc_array ['tank_size'] = (($tempValue & 0x08) == 0x08) ? "Small" : "Large";
			$assoc_array ['broken_pipe'] = (($tempValue & 0x10) == 0x10) ? "On" : "Off";
			$assoc_array ['blurred_carrier'] = (($tempValue & 0x20) == 0x20) ? "On" : "Off";
			$assoc_array ['minimum_fan'] = (($tempValue & 0x40) == 0x40) ? "Off" : "On";
		}
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ),
				'underload_setpoint' => Input::get ( 'UNDSP' ) == null ? null : ( float ) Input::get ( 'UNDSP' ),
				'underload_hours' => Input::get ( 'UNDH' ) == null ? null : ( int ) Input::get ( 'UNDH' ),
				'underload_minutes' => Input::get ( 'UNDM' ) == null ? null : ( int ) Input::get ( 'UNDM' ),
				'underload_seconds' => Input::get ( 'UNDS' ) == null ? null : ( int ) Input::get ( 'UNDS' ),
				'maximum_frequency' => Input::get ( 'MAXF' ) == null ? null : ( int ) Input::get ( 'MAXF' ),
				'minimum_frequency' => Input::get ( 'MINF' ) == null ? null : ( int ) Input::get ( 'MINF' ),
				'language' => Input::get ( 'LANG' ) 
		);
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'config_event_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Current Limit Event History Table
	public function importCurrentLimitHistory() {
		$assoc_array = array ();
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
		
		// Fields for a set of Total Events /*FaultEventInfo[5] and FaultEventInfo[4] */
		if (array_key_exists ( 'TEVENMSB', Input::all () ) && array_key_exists ( 'TEVENLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'TEVENMSB' )) * 65536 + (( int ) Input::get ( 'TEVENLSB' )));
			$assoc_array ['total_events'] = $tempValue;
		}
		
		// Fields for a set of Total Events On This Cycle /*FaultEventInfo[7] and FaultEventInfo[6] */
		if (array_key_exists ( 'TEVENOCMSB', Input::all () ) && array_key_exists ( 'TEVENOCLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'TEVENOCMSB' )) * 65536 + (( int ) Input::get ( 'TEVENOCLSB' )));
			$assoc_array ['total_events_on_this_cycle'] = $tempValue;
		}
		
		// Fields for a set of First Event Start Time /*FaultEventInfo[9] and FaultEventInfo[8] */
		if (array_key_exists ( 'FEVENSTMSB', Input::all () ) && array_key_exists ( 'FEVENSTLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'FEVENSTMSB' )) * 65536 + (( int ) Input::get ( 'FEVENSTLSB' )));
			$assoc_array ['first_event_start_time'] = $tempValue;
		}
		
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ),
				'current_phase_a' => Input::get ( 'CURPA' ) == null ? null : (( float ) Input::get ( 'CURPA' )),
				'current_phase_b' => Input::get ( 'CURPB' ) == null ? null : (( float ) Input::get ( 'CURPB' )),
				'current_phase_c' => Input::get ( 'CURPC' ) == null ? null : ( float ) Input::get ( 'CURPC' ) 
		);
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'current_limit_event_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Fault History Table
	public function importFaultHistory() {
		$assoc_array = array ();
		
		$assoc_array += ImportingController::converttoDHM ( ( double ) Input::get ( 'TTIMEMSB' ), 'total' );
		// $assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
		
		// Fields for a set of Fault and Fault Counter /*FaultEventInfo[0]*/
		if (array_key_exists ( 'FAULT', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'FAULT' );
			$assoc_array ['fault'] = $tempValue % 256;
			$assoc_array ['fault_counter'] = $tempValue / 256;
		}
		
		// Fields for a set of configuration such as Soft Charge, PFC Status, Commun. Status, Bootstrap in Progr., DC Teste, .../*FaultEventInfo[21]*/
		if (array_key_exists ( 'CONFIG1', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'CONFIG1' );
			$assoc_array ['soft_charge'] = (($tempValue & 0x0001) == 0x0001) ? "On" : "Off";
			$assoc_array ['pfc_status'] = (($tempValue & 0x0002) == 0x0002) ? "On" : "Off";
			$assoc_array ['communication_status'] = (($tempValue & 0x0004) == 0x0004) ? "Fault" : "No Fault";
			$assoc_array ['inverter_sc_status'] = (($tempValue & 0x0008) == 0x0008) ? "Fault" : "No Fault";
			$assoc_array ['inverter_enabled'] = (($tempValue & 0x0010) == 0x0010) ? "On" : "Off";
			$assoc_array ['boostrap_in_progress'] = (($tempValue & 0x0020) == 0x0020) ? "Yes" : "No";
			$assoc_array ['dc_test_in_progress'] = (($tempValue & 0x0040) == 0x0040) ? "Yes" : "No";
			$assoc_array ['ac_test_in_progress'] = (($tempValue & 0x0080) == 0x00080) ? "Yes" : "No";
			$assoc_array ['bump_in_progress'] = (($tempValue & 0x0100) == 0x0100) ? "Yes" : "No";
			$assoc_array ['ac_pressure_in_progress'] = (($tempValue & 0x0200) == 0x0200) ? "Yes" : "No";
			$assoc_array ['shake_motor_in_progress'] = (($tempValue & 0x0400) == 0x0400) ? "Yes" : "No";
			$assoc_array ['open_circuit_detected'] = (($tempValue & 0x0800) == 0x0800) ? "Fault" : "No Fault";
			$assoc_array ['short_circuit_detected'] = (($tempValue & 0x1000) == 0x1000) ? "Fault" : "No Fault";
			$assoc_array ['phase_imbalance'] = (($tempValue & 0x2000) == 0x2000) ? "Fault" : "No Fault";
			$assoc_array ['pressure_switch_closed'] = (($tempValue & 0x4000) == 0x4000) ? "Yes" : "No";
			$assoc_array ['hobb_circuit_fault_detected'] = (($tempValue & 0x8000) == 0x8000) ? "Fault" : "No Fault";
		}
		
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ),
				'current_phase_a' => Input::get ( 'CURPA' ) == null ? null : (( float ) Input::get ( 'CURPA' )),
				'current_phase_b' => Input::get ( 'CURPB' ) == null ? null : (( float ) Input::get ( 'CURPB' )),
				'current_phase_c' => Input::get ( 'CURPC' ) == null ? null : ( float ) Input::get ( 'CURPC' ),
				'inverter_temperature' => Input::get ( 'ITMP' ) == null ? null : (( float ) Input::get ( 'ITMP' )) / 10,
				'pfc_temperature' => Input::get ( 'ITMP' ) == null ? null : (( float ) Input::get ( 'ITMP' )) / 10,
				'rect_voltage' => Input::get ( 'RVOLT' ) == null ? null : (( float ) Input::get ( 'RVOLT' )) / 100,
				'bus_voltage' => Input::get ( 'BVOLT' ) == null ? null : (( float ) Input::get ( 'BVOLT' )) / 100,
				'fan_speed' => Input::get ( 'FSPD' ) == null ? null : ( float ) Input::get ( 'FSPD' ),
				'boostrap_in_progress' => Input::get ( 'BSPROG' ) == null ? null : ( float ) Input::get ( 'BSPROG' ),
				'max_speed_allowed' => Input::get ( 'MAXSPD' ) == null ? null : ( float ) Input::get ( 'MAXSPD' ),
				'speed_limiter_motor_id' => Input::get ( 'SPDMID' ),
				'targed_speed' => Input::get ( 'TSPD' ) == null ? null : ( float ) Input::get ( 'TSPD' ),
				'mcb_sw' => Input::get ( 'MCBSW' ) == null ? null : ( float ) Input::get ( 'MCBSW' ),
				'underload_sensor_setting' => Input::get ( 'ULSENSET' ) == null ? null : ( float ) Input::get ( 'ULSENSET' ),
				'status_flags' => Input::get ( 'CONFIG2' ) == null ? null : ( int ) Input::get ( 'CONFIG2' ), /* FaultEventInfo[22] */
				'error_exid_id' => Input::get ( 'ERRID' ) == null ? null : ( int ) Input::get ( 'ERRID' ),
				'current_demand' => Input::get ( 'CDMD' ) == null ? null : ( float ) Input::get ( 'CDMD' ),
				'i2c_status' => Input::get ( 'I2CSTS' ) == null ? null : ( int ) Input::get ( 'I2CSTS' ) 
		);
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'fault_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Motor On Time Event History Table
	public function importMotorOnTimeHistory() {
		$assoc_array = array ();
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
		
		// Fields for a set of Fault and Fault Counter /*FaultEventInfo[0]*/
		if (array_key_exists ( 'FAULT', Input::all () )) {
			$tempValue = ( int ) Input::get ( 'FAULT' );
			$assoc_array ['fault'] = $tempValue % 256;
			$assoc_array ['fault_counter'] = $tempValue / 256;
		}
		
		// Fields for a set of Total Starts /*FaultEventInfo[5] and FaultEventInfo[4] */
		if (array_key_exists ( 'TSTSMSB', Input::all () ) && array_key_exists ( 'TSTSLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'TSTSMSB' )) * 65536 + (( int ) Input::get ( 'TSTSLSB' )));
			$assoc_array ['total_starts'] = $tempValue;
		}
		
		// Fields for a set of Total Starts On This Cycle /*FaultEventInfo[7] and FaultEventInfo[6] */
		if (array_key_exists ( 'STSOCMSB', Input::all () ) && array_key_exists ( 'STSOCLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'STSOCMSB' )) * 65536 + (( int ) Input::get ( 'STSOCLSB' )));
			$assoc_array ['starts_on_this_cycle'] = $tempValue;
		}
		
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ) 
		);
		
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'motor_on_time_event_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Overload History Table
	public function importOverloadHistory() {
		$assoc_array = array ();
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		//$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
				
		// Fields for a set of Total Events /*FaultEventInfo[3] and FaultEventInfo[2] */
		if (array_key_exists ( 'TEVENMSB', Input::all () ) && array_key_exists ( 'TEVENLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'TEVENMSB' )) * 65536 + (( int ) Input::get ( 'TEVENLSB' )));
			$assoc_array ['total_events'] = $tempValue;
		}
		
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ) 
		);
		
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'overload_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Power On time Event History Table
	public function importPowerOnTimeHistory() {
		$assoc_array = array ();
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );	
	
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' )
		);
	
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'power_on_time_event_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Reset Event History Table
	public function importResetHistory() {
		$assoc_array = array ();
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
	
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ),
				'reset_source' => Input::get ( 'RSTSRC' ),
				'reset_type' => Input::get ( 'RSTTYPE' )				
		);
	
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'reset_event_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
	
	// Controller of importing data to Temperature Event History Table
	public function importTemperatureHistory() {
		$assoc_array = array ();
		$assoc_array += ImportingController::converttoDHM ( 'total' );
		$assoc_array += ImportingController::converttoDHM ( 'this_cycle' );
	
		// Fields for a set of Total Events /*FaultEventInfo[5] and FaultEventInfo[4] */
		if (array_key_exists ( 'TEVENMSB', Input::all () ) && array_key_exists ( 'TEVENLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'TEVENMSB' )) * 65536 + (( int ) Input::get ( 'TEVENLSB' )));
			$assoc_array ['total_events'] = $tempValue;
		}
		
		// Fields for a set of Total Events On This Cycle /*FaultEventInfo[7] and FaultEventInfo[6] */
		if (array_key_exists ( 'TEVENOCMSB', Input::all () ) && array_key_exists ( 'TEVENOCLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'TEVENOCMSB' )) * 65536 + (( int ) Input::get ( 'TEVENOCLSB' )));
			$assoc_array ['total_events_on_this_cycle'] = $tempValue;
		}
		
		// Fields for a set of First Event Start Time /*FaultEventInfo[9] and FaultEventInfo[8] */
		if (array_key_exists ( 'FEVENSTMSB', Input::all () ) && array_key_exists ( 'FEVENSTLSB', Input::all () )) {
			$tempValue = ( double ) ((( int ) Input::get ( 'FEVENSTMSB' )) * 65536 + (( int ) Input::get ( 'FEVENSTLSB' )));
			$assoc_array ['first_event_start_time'] = $tempValue;
		}
		
		$assoc_array += array (
				'log_number' => Input::get ( 'LOGN' ) == null ? null : ( int ) Input::get ( 'LOGN' ),
				'reset_source' => Input::get ( 'TEMPSRC' ),
				'inverter_temperature' => Input::get ( 'ITMP' ) == null ? null : (( float ) Input::get ( 'ITMP' )) / 10,
				'pfc_temperature' => Input::get ( 'PTMP' ) == null ? null : (( float ) Input::get ( 'PTMP' )) / 10
		);
	
		$subdrive_record = DB::table ( 'subdrives' )->where ( 'serial_number', Route::input ( 'serial_number' ) );
		$subdrive_id = 1;
		if ($subdrive_record) {
			$subdrive_id = $subdrive_record->id;
		}
		$assoc_array ['subdrive_id'] = $subdrive_id;
		$ok = DB::table ( 'temperature_event_history' )->insert ( $assoc_array ); // ->where('serial_number',"=",Route::input('serial_number'))->count ();
		if ($ok) {
			$count = 0;
			foreach ( Input::all () as $key => $value ) {
				$count += strlen ( $value );
			}
			return $count;
		} else {
			return "Error while saving data to database!";
		}
	}
}