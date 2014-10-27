@extends('templates.jtable_template')
@section('body')
<div id="reset_event_history" style="width: 2400px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#reset_event_history').jtable({
				title: 'Reset Event History for {{$serial_number}}',
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
					reset_source: {
						title: 'Reset Source',
						width: '100%'
					},
					reset_type: {
						title: 'Reset Type',
						width: '100%'
					}
				}
			});

			//Load general_info list from server
			$('#reset_event_history').jtable('load');

		});
	</script>
	@stop