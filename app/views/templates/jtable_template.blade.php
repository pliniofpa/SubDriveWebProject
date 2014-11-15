<!-- app/views/templates/jtable_template.blade.php -->
@extends('templates.main')    
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
<div id="center_content" style="overflow-x: auto">
	@yield('table_content')
</div>	
@stop

{{-- Passes title to main template. --}}
@section('title')
@yield('title')
@stop
