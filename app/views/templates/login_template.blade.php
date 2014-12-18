<!-- app/views/templates/login_template.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
<title>SubDrive Web Sytem Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap Core CSS -->
<link href="{{asset('sb-admin-2/css/bootstrap.min.css')}}"
	rel="stylesheet">
<style type="text/css">
/*
body
{
	background: url("{{asset('images/background.jpg')}}");
    background-size: 34em 45.6em;
    background-repeat: x-repeat 
}
*/
body:before {
	content: ' ';
	display: block;
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	z-index: -1;
	opacity: 0.2;
	background: url("{{asset('images/background.jpg')}}");
	background-size: 100% 100%;
	background-repeat: no-repeat;
}
</style>
<!-- jQuery Version 1.11.0 -->
<script src="{{asset('sb-admin-2/js/jquery.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('sb-admin-2/js/bootstrap.min.js')}}"></script>
</head>
<body>
	<div>
		<img style="margin-top: 10px; margin-left: 20px;"
			src="{{asset('images/FE_stacked_color.png')}}" alt="Franklin Logo"
			height="70px" width="250px">
			
		<p class="text-center" style="font: bold 3.7em Arial;">
			Welcome to<br>SubDrive Web System
		</p>
		<p></p>
	</div>

	<div class="container">
		@yield('box')
	</div>

	<script type="text/javascript">

</script>
</body>
</html>