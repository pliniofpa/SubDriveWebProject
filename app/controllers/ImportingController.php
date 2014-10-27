<?php
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
	 * |	Route::get('/', 'ImportingController@importGeneralInfo');
	 * |
	 */
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
		// Fields for Serial Number
		/*
		$serial = null;
		for($i = 0; $i < 12; $i ++) {
			if ($i < 9) {
				$key = 'SN0' . (( string ) $i);
			} else {
				$key = 'SN' . (( string ) $i);
			}
			if (array_key_exists ( $key, Input::all () )) {
				if ($serial == null) {
					$serial = '';
				}
				$serial .= Input::get ( $key );
			}
		}
		*/
		// Fields for MCB SW
		if (array_key_exists ( 'MBS0', Input::all () ) && array_key_exists ( 'MBS1', Input::all () )) {
			$assoc_array ['mcb_sw_version'] = Input::get ( 'MBS0' ) . Input::get ( 'MBS1' );
		}
		// Fields for MCB SW
		if (array_key_exists ( 'DBS0', Input::all () ) && array_key_exists ( 'DBS1', Input::all () )) {
			$assoc_array ['mcb_sw_version'] = Input::get ( 'DBS0' ) . Input::get ( 'DBS1' );
		}
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
				'hardware_version' => Input::get ( 'VIN1' ) == null ? null : ( float ) Input::get ( 'VIN1' ),
				'demand' => Input::get ( 'DMND' ) == null ? null : ( float ) Input::get ( 'DMND' ),
				'serial_number' => Input::get ( 'SN' ),
				'motor_size' => Input::get ( 'MTSW' ),
				'pump_size' => Input::get ( 'PMSW' ),
				'underload_sense_value' => Input::get ( 'USNS' ) == null ? null : ( float ) Input::get ( 'USNS' ),
				'underload_hours' => Input::get ( 'UTHR' ) == null ? null : ( int ) Input::get ( 'UTHR' ),
				'underload_minutes' => Input::get ( 'UTHM' ) == null ? null : ( int ) Input::get ( 'UTHM' ),
				'underload_seconds' => Input::get ( 'UTHS' ) == null ? null : ( int ) Input::get ( 'UTHS' ),
				'language' => Input::get ( 'LANG' ),
				'package_id' => Input::get ( 'PKID' ),
				'model_number' => Input::get ( 'MDNR' ),
				'subdrive_id' => Input::get ( 'HWVR' ) 
		);
		//$subdrive_id = DB::table('subdrives')->where('serial_number',"==",Route::input('serial_number'))->id;
		$subdrive_id = 1;
		$assoc_array['subdrive_id'] = $subdrive_id;
		$ok = DB::table ('general_info')->insert($assoc_array);//->where('serial_number',"=",Route::input('serial_number'))->count ();
		if($ok){
			$count=0;
			foreach (Input::all() as $key => $value){
				$count+=strlen($value);
			}
			return $count;
		}else{
			return "Error while saving data to database!";
		}
	}
	
	
	public function importCommunicationHistory() {
		
	}
}