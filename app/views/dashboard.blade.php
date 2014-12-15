<!-- app/views/dashboard.blade.php -->
<?php 
$serial_number = "serial_number_for_dashboard";
?>
<script type="text/javascript">
<!--
//Set current table menu active
$('#dashboard_link').addClass("active");
//-->
</script>

@extends('templates.main')

@section('title')
{{" - Dashboard - $serial_number"}}	
@stop

@section('header')
{{"Dashboard - $serial_number"}}
@stop

{{-- Populate head section on main template with needed scripts. --}}
@section('head')

	<!-- jTable CSS -->
	<link href="{{asset('scripts/jquery-ui-1.11.1/jquery-ui.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('scripts/jtable-2.4.0/themes/metro/blue/jtable.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('scripts/helper.css')}}" rel="stylesheet" type="text/css" />
	
	
	<!-- jTable JavaScript -->	
    <script src="{{asset('scripts/jquery-ui-1.11.1/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('scripts/jtable-2.4.0/jquery.jtable.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('scripts/helper.js')}}" type="text/javascript"></script>
@stop

{{-- Passes content to main template. --}}
<?php
$serial_number = '0000000SNNPG0';
//Recover the last added item from general_info table 
$general_info_table_last_row = DB::table('general_info')->where('serial_number',$serial_number)->latest()->first();
//Create array that links table fiels with Labels
$assoc_array = array(
		'number' => '#',
		'hardware_version' => 'Hardware Version',
		'drive_type_dip_switch' => 'Drive Type Dip Switch',
		'pot_mode' => 'PotMode',
		'input_voltage' => 'Input Voltage (V rms)',
		'output_voltage_a' => 'Output Voltage A (V rms)',
		'output_voltage_b' => 'Output Voltage B (V rms)',
		'output_voltage_c' => 'Output Voltage C (V rms)',
		'output_current_a' => 'Output Current A (I rms)',
		'output_current_b' => 'Output Current B (I rms)',
		'output_current_c' => 'Output Current C (I rms)',
		'demand' => '% Demand',
		'drive_status' => 'Drive Status',
		'hp_kw' => 'HP / kW',
		'fe_connect_dip' => 'FE Connect Dip Switch',
		'bump' => 'Bump',
		'agressive_bump' => 'Agressive Bump',
		'tank_size' => 'Tank Size',
		'broken_pipe' => 'Broken Pipe',
		'blurred_carrier' => 'Blurred Carrier',
		'constant_minimum_fan' => 'Constant Minimum Fan',
		'serial_number' => 'Serial Number',
		'motor_size' => 'Motor Size',
		'pump_size' => 'Pump Size',
		'steady_flow' => 'Steady Flow',
		'underload_sense_value' => 'Underload Sensor Value',
		'underload_hours' => 'Underload Hours',
		'underload_minutes' => 'Underload Minutes',
		'underload_seconds' => 'Underload Seconds',
		'maximum_frequency' => 'Maximum Frequency',
		'minimum_frequency' => 'Minimum Frequency',
		'language' => 'Language ',
		'output_frequency' => 'Output Frenquency',
		'inverter_temperature' => 'Inverter Temperature (°C)',
		'pfc_temperature' => 'PFC Temperature (°C)',
		'mcb_sw_version' => 'DWB S/W Version',
		'package_id' => 'Package ID',
		'model_number' => 'Model Number'		
);
$result_array = array();
foreach ($assoc_array as $column => $label){
	foreach ($general_info_table_last_row as $column_table => $value){
		if($column==$column_table){
			$result_array[$label] = $general_info_table_last_row->$column_table;
			break;
		}
	}	
}
//var_dump($general_info_table_last_row);
//var_dump($result_array);
?>

@section('content')
	<!-- Content Here -->
	<div class="row">
	@foreach($result_array as $label => $value)
	<div class="col-xs-6"><b>{{$label.": "}}</b>{{$value}}</div>
	@endforeach
	</div>
	<div class="row">
	<h1 class="col-xs-12 page-header"></h1>
	</div>
@stop


