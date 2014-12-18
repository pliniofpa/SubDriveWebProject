<!-- app/views/templates/register.blade.php -->
@extends('templates.login_template') {{-- Populate head section on main
template with needed scripts. --}} 
@section('box')

<div id="signupbox" style="margin-top: 50px"
	class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Sign Up</div>
			<div
				style="float: right; font-size: 85%; position: relative; top: -10px">
				<a id="signinlink" href='{{URL::route("login")}}'>Sign In</a>
			</div>
		</div>
		<div class="panel-body">
			<form id="signupform" class="form-horizontal" role="form" action='{{URL::route("register_post")}}' method="POST">
				
				@if($errors->any())
				<div id="signupalert"
					class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $message)
						<li>{{ $message }}</li> @endforeach
					</ul>
				</div>
				@endif



				<div class="form-group">
					<label for="email" class="col-md-3 control-label">Email</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="email"
							placeholder="Email Address">
					</div>
				</div>

				<div class="form-group">
					<label for="firstname" class="col-md-3 control-label">First Name</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="firstname"
							placeholder="First Name">
					</div>
				</div>
				<div class="form-group">
					<label for="lastname" class="col-md-3 control-label">Last Name</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="lastname"
							placeholder="Last Name">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-md-3 control-label">Password</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="password"
							placeholder="Password">
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="col-md-3 control-label">Password
						Confirmation</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="password_confirm"
							placeholder="Password">
					</div>
				</div>

				<div class="form-group">
					<label for="icode" class="col-md-3 control-label">Company</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="company"
							placeholder="Company Name">
					</div>
				</div>

				<div class="form-group">
					<label for="icode" class="col-md-3 control-label">SubDrive Serial
						Number</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="serial_number"
							placeholder="FECNCT000000">
					</div>
				</div>

				<div class="form-group">
					<!-- Button -->
					<div class="col-md-offset-3 col-md-9">
						<input id="btn-signup" type="submit" class="btn btn-info" value="&nbsp Sign Up">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
