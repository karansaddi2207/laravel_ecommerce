@extends('layouts.frontLayout.front_design')

@section('content')

<section id="form" style="margin-top:20px"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						@if(Session::has('flash_message_success'))
    					<div class="alert alert-block alert-error" style="background-color: #f4d2d2">
    						<button type="button" class="close" data-dismiss="alert">x</button>
    						{!! session('flash_message_success') !!}
    					</div>
  				  		@endif
						<h2>Login to your account</h2>
						<form action="{{ url('/user_login') }}" method="post" id="loginForm" name="loginForm">{{ csrf_field() }}
							<input type="text" name="email" id="email" placeholder="Email Address" />
							<input type="password" name="password" id="password" placeholder="Password" />
							<!--<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>-->
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="post" id="registerForm" name="registerForm" action="{{ url('/user_register') }}">{{ csrf_field() }}
							<input type="text" id="name" name="name" placeholder="Name"/>
							<input type="email" name="email" placeholder="Email Address"/>
							<input type="password" id="myPassword" name="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection