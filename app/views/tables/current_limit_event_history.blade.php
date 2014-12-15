@extends('templates.jtable_template')
@section('title')
{{" - Current Limit Event History - $serial_number"}}
@stop
@section('header')
{{"Current Limit Event History - $serial_number"}}
@stop
@section('table_content')
<div id="current_limit_event_history" class="jtable_table" style="width: 2400px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#current_limit_event_history').jtable({
				title: 'Current Limit Event History for {{$serial_number}}',
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
					}
				}
			});

			//Load general_info list from server
			$('#current_limit_event_history').jtable('load');
			
			//Set current table menu active
			$('#tables_link').addClass("active");
			$('#current_limit_event_history_table_link').addClass("active");

		});
	</script>
	@stop
