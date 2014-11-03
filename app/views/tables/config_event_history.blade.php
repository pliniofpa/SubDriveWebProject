@extends('templates.jtable_template')
@section('table_content')
<div id="config_event_history" style="width: 2400px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#config_event_history').jtable({
				title: 'Config Event History for {{$serial_number}}',
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
						title: 'Log #   ',
						width: '10%'
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
					this_cycle_on_days: {
						title: "This Cycle on Days",
						width: '100%'
					},
					this_cycle_on_hours: {
						title: 'This Cycle On Hours',
						width: '100%'
					},
					this_cycle_on_minutes: {
						title: 'This Cycle On Minutes',
						width: '100%'
					},
					fe_connected: {
						title: 'FE Connected',
						width: '100%'
					},
					drive_type: {
						title: 'Drive Type',
						width: '100%'
					},
					steady_flow: {
						title: 'Steady Flow',
						width: '100%'
					},
					device_config: {
						title: 'Device_Config',
						width: '100%'
					},
					motor_size: {
						title: 'Motor Size',
						width: '100%'
					},
					pump_size: {
						title: 'Pump_Size',
						width: '100%'
					},
					units_configuration: {
						title: 'Unit Configurations',
						width: '100%'
					},
					bump_configuration: {
						title: 'Bump Configuration',
						width: '100%'
					},
					agressive_bump: {
						title: 'Agressive Bump',
						width: '100%'
					},
					tank_size: {
						title: 'Tank Size',
						width: '100%'
					},
					broken_pipe: {
						title: 'Bronken Pipe',
						width: '100%'
					},
					blurred_carrier: {
						title: 'Blurred Carrier',
						width: '100%'
					},
					minimum_fan: {
						title: 'Minimum Fan',
						width: '100%'
					},
					underload_setpoint: {
						title: 'Underload Setpoint',
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
					this_cycle_on_minutes: {
						title: 'This Cycle On Minutes',
						width: '100%'
					},
					maximum_frequency: {
						title: 'Maximum Frequency (Hz)',
						width: '100%'
					},
					minimum_frequency: {
						title: 'Minimum Frequency (Hz)',
						width: '100%'
					},
					language: {
						title: 'Language',
						width: '100%'
					}
				}
			});

			//Load general_info list from server
			$('#config_event_history').jtable('load');

		});
	</script>
	@stop
