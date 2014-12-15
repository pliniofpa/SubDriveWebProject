@extends('templates.jtable_template')
@section('title')
{{" - Fault History - $serial_number"}}
@stop
@section('header')
{{"Fault History - $serial_number"}}
@stop
@section('table_content')
<div id="fault_hist" class="jtable_table" style="width: 6400px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#fault_hist').jtable({
				title: 'Fault History for {{$serial_number}}',
				paging: true,
				sorting: true,
				loadingRecords: function (event, data){
					resize_headers();
					return true;
					},
				actions: {
					//listAction: '{{URL::to($table_name."/list/".$serial_number)}}'
					listAction: '{{URL::route("tables_data_list",array($table_name,$serial_number))}}'
				},
				fields: {
					id: {
						key: true,
						list: false
					},
					log_number: {
						title: 'Log #  ',
						width: '100%'
					},
					fault: {
						title: 'Fault  ',
						width: '100%'
					},
					fault_counter: {
						title: 'Fault Counter',
						width: '100%'
					},
					total_on_days: {
						title: "Total on Days",
						width: '100%'
					},
					total_on_hours: {
						title: 'Total On Hours',
						width: '100%'
					},
					total_on_minutes: {
						title: 'Total On Minutes',
						width: '100%'
					},
					current_phase_a: {
						title: 'Current Phase A (A)',
						width: '100%'
					},
					current_phase_b: {
						title: 'Current Phase B (A)',
						width: '100%'
					},
					current_phase_c: {
						title: 'Current Phase C (A)',
						width: '100%'
					},
					inverter_temperature: {
						title: 'Inverter Temperature (°C)',
						width: '100%'
					},
					pfc_temperature: {
						title: 'PFC Temperature (°C)',
						width: '100%'
					},
					rect_voltage: {
						title: 'Rect. Voltage (V)',
						width: '100%'
					},
					bus_voltage: {
						title: 'Rect. Voltage (V)',
						width: '100%'
					},
					fan_speed: {
						title: 'Fan Speed ',
						width: '100%'
					},
					boostrap_in_progress: {
						title: 'Boostrap in Progress',
						width: '100%'
					},
					max_speed_allowed: {
						title: 'Max Speed Allowed',
						width: '100%'
					},
					speed_limiter_motor: {
						title: 'Speed Limiter Motor',
						width: '100%'
					},
					target_speed: {
						title: 'Target Speed',
						width: '100%'
					},
					mcb_sw: {
						title: 'MCB Software',
						width: '100%'
					},
					underload_sensor_setting: {
						title: 'Underload Sensor Setting',
						width: '100%'
					},
					soft_charge: {
						title: 'Software Charge',
						width: '100%'
					},
					pfc_status: {
						title: 'PFC Status ',
						width: '100%'
					},
					communcation_status: {
						title: 'Communcation Status',
						width: '100%'
					},
					inverter_sc_status: {
						title: 'Inverter Status',
						width: '100%'
					},
					inverter_enabled: {
						title: 'Inverter Enabled',
						width: '100%'
					},
					dc_test_in_progress: {
						title: 'DC Teste in Progress',
						width: '100%'
					},
					ac_test_in_progress: {
						title: 'AC Teste in Progress',
						width: '100%'
					},
					bump_in_progress: {
						title: 'Bump in Progress',
						width: '100%'
					},
					ac_pressure_in_progress: {
						title: 'AC Pressure in Progress',
						width: '100%'
					},
					shake_motor_in_progress: {
						title: 'Shake Motor in Progress',
						width: '100%'
					},
					open_circuit_detected: {
						title: 'Open Circuit Detected',
						width: '100%'
					},
					shot_circuit_detected: {
						title: 'Short Circuit Detected',
						width: '100%'
					},
					phase_imbalance: {
						title: 'Phase in Balance',
						width: '100%'
					},
					pressure_switch_closed: {
						title: 'Pressure Switch Closed',
						width: '100%'
					},
					hobb_circuit_fault_detected: {
						title: 'Hobb Circuit Fault Detected',
						width: '100%'
					},
					status_flags: {
						title: 'Status Flags',
						width: '100%'
					},
					error_exit_id: {
						title: 'Error Exit ID',
						width: '100%'
					},
					current_demand: {
						title: 'Current Demand',
						width: '100%'
					},
					i2c_status: {
						title: 'I2C Status',
						width: '100%'
					}
				}
			});

			//Load general_info list from server
			$('#fault_hist').jtable('load');
			
			//Set current table menu active
			$('#tables_link').addClass("active");
			$('#fault_history_table_link').addClass("active");

		});
	</script>
	@stop
