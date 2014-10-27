@extends('templates.jtable_template')
@section('body')
<div id="communication_event_history" style="width: 2400px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#communication_event_history').jtable({
				title: 'Communication Event History for {{$serial_number}}',
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
					dwb_total_errors: {
						title: 'DWB Total Errors',
						width: '100%'
					},
					dwb_errors_at_powerup: {
						title: 'DWB Errors at Powerup',
						width: '100%'
					},
					dwb_errors_on_this_cycle: {
						title: 'DWB Errors on This Cycle',
						width: '100%'
					},
					exb_total_errors: {
						title: 'EXB Total Errors',
						width: '100%'
					},
					exb_errors_at_powerup: {
						title: 'EXB Errors at Powerup',
						width: '100%'
					},
					exb_errors_on_this_cycle: {
						title: 'EXB Errors on This Cycle',
						width: '100%'
					},
					mcb_total_errors: {
						title: 'MCB Total Errors',
						width: '100%'
					},
					mcb_errors_at_powerup: {
						title: 'MCB Errors at Powerup',
						width: '100%'
					},
					mcb_errors_on_this_cycle: {
						title: 'MCB Errors on This Cycle',
						width: '100%'
					}
				}
			});

			//Load general_info list from server
			$('#communication_event_history').jtable('load');

		});
	</script>
	@stop
