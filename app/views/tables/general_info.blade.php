@extends('templates.jtable_template')
@section('body')
<div id="general_info" style="width: 5600px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#general_info').jtable({
				title: 'General Information for {{$serial_number}}',
				paging: true,
				sorting: true,
				jqueryuiTheme: false,
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
					request_number: {
						title: 'Request #  ',
						width: '10%'
					},
					hardware_version: {
						title: "Hardware Version",
						width: '100%'
					},
					drive_type_dip_switch: {
						title: 'Drive Type Dip Switch',
						width: '100%'
					},
					pot_mode: {
						title: 'PotMode   ',
						width: '100%'
					},
					input_voltage: {
						title: 'Input Voltage (V rms)',
						width: '100%'
					},
					output_voltage_a: {
						title: 'Output Voltage A (V rms)',
						width: '100%'
					},
					output_voltage_b: {
						title: 'Output Voltage B (V rms)',
						width: '100%'
					},
					output_voltage_c: {
						title: 'Output Voltage C (V rms)',
						width: '100%'
					},
					output_current_a: {
						title: 'Output Current A (V rms)',
						width: '100%'
					},
					output_current_b: {
						title: 'Output Current B (V rms)',
						width: '100%'
					},
					output_current_c: {
						title: 'Output Current C (V rms)',
						width: '100%'
					},
					demand: {
						title: '% Demand   ',
						width: '100%'
					},
					drive_status: {
						title: 'Drive Status',
						width: '100%'
					},
					hp_kw: {
						title: 'HP / kW  ',
						width: '100%'
					},
					fe_connect_dip: {
						title: 'FE Connect Dip Switch',
						width: '100%'
					},
					bump: {
						title: 'Bump   ',
						width: '100%'
					},
					agressive_bump: {
						title: 'Agressive Bump',
						width: '100%'
					},
					tank_size: {
						title: 'Tank Size  ',
						width: '100%'
					},
					broken_pipe: {
						title: 'Broken Pipe ',
						width: '100%'
					},
					blurred_carrier: {
						title: 'Blurred Carrier',
						width: '100%'
					},
					constant_minimum_fan: {
						title: 'Constant Minimum Fan',
						width: '100%'
					},
					serial_number: {
						title: 'Serial Number ',
						width: '100%'
					},
					motor_size: {
						title: 'Motor Size  ',
						width: '100%'
					},
					pump_size: {
						title: 'Pump Size  ',
						width: '100%'
					},
					steady_flow: {
						title: 'Steady Flow',
						width: '100%'
					},
					underload_sense_value: {
						title: 'Underload Sensor Value',
						width: '100%'
					},
					underload_hours: {
						title: 'Underload Hours',
						width: '100%'
					},
					underload_minutes: {
						title: 'Underload Minutes',
						width: '100%'
					},
					underload_seconds: {
						title: 'Underload Seconds',
						width: '100%'
					},
					maximum_frequency: {
						title: 'Maximum Frequency',
						width: '100%'
					},
					minimum_frequency: {
						title: 'Minimum Frequency',
						width: '100%'
					},
					language: {
						title: 'Language  ',
						width: '100%'
					},
					output_frequency: {
						title: 'Age   ',
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
					mcb_sw_version: {
						title: 'DWB S/W Version',
						width: '100%'
					},
					package_id: {
						title: 'Package ID  ',
						width: '100%'
					},
					model_number: {
						title: 'Model Number  ',
						width: '100%'
					}
				}
			});

			//Load general_info list from server
			$('#general_info').jtable('load');

		});
	</script>
	@stop
