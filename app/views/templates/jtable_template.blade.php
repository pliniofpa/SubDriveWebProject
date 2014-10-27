<!-- app/views/tables/jtable_template.blade.php -->
<html>
  <head>
	<meta charset="UTF-8">
	<link href="{{asset('scripts/jquery-ui-1.11.1/jquery-ui.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('scripts/jtable-2.4.0/themes/metro/blue/jtable.css')}}" rel="stylesheet" type="text/css" />
	
	<script src="{{asset('scripts/jquery-1.11.1.min.js" type="text/javascript')}}"></script>
    <script src="{{asset('scripts/jquery-ui-1.11.1/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('scripts/jtable-2.4.0/jquery.jtable.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('scripts/myscript.js')}}" type="text/javascript"></script>
    	
  </head>
  <body>
	@yield('body') 
  </body>
</html>