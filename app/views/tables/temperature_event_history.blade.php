@extends('templates.jtable_template')
@section('table_content')
<div id="temperature_event_history" style="width: 2400px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#temperature_event_history').jtable({
				title: 'Temperature Event History for {{$serial_number}}',
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
						title: 'Total on Hours',
						width: '100%'
					},
					total_on_minutes: {
						title: 'Total on Minutes',
						width: '100%'
					},
					this_cycle_on_days: {
						title: "This Cycle on Days",
						width: '100%'
					},
					this_cycle_on_hours: {
						title: 'This Cycle on Hours',
						width: '100%'
					},
					this_cycle_on_minutes: {
						title: 'This Cycle on Minutes',
						width: '100%'
					},
					total_events: {
						title: 'Total Events',
						width: '100%'
					},
					total_events_on_this_cycle: {
						title: 'Total Events on This Cycle',
						width: '100%'
					},
					first_event_start_time: {
						title: 'First Event Start Time',
						width: '100%'
					},
					temperature_source: {
						title: 'Temperature Source',
						width: '100%'
					},
					inverter_temperature: {
						title: 'Inverter Temperature (°C)',
						width: '100%'
					},
					pfc_temperature: {
						title: 'PFC Temperature (°C)',
						width: '100%'
					}
				}
			});

			//Load general_info list from server
			$('#temperature_event_history').jtable('load');

		});
	</script>
	@stop
