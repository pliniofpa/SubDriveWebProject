<!-- app/views/dashboard.blade.php -->
<?php 
$serial_number = "serial_number";
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
@section('content')
	<!-- Content Here -->
@stop


