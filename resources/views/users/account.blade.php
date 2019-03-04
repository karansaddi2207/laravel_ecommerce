@extends('layouts.frontLayout.front_design')

@section('content')

<section id="form" style="margin-top:20px"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						@if(Session::has('flash_message_success'))
    					<div class="alert alert-error alert-block" style="background-color: #f4d2d2">
    						<button type="button" class="close" data-dismiss="alert">x</button>
    						{!! session('flash_message_success') !!}
    					</div>
  				  		@endif
						<h2>Update account</h2>
						<form method="post" id="accountForm" name="accountForm" action="{{ url('/account') }}">{{ csrf_field() }}
							<input type="text" name="name" id="name" value="{{ $userDetails->name }}" placeholder="Name">
							<input type="text" name="address" id="address" value="{{ $userDetails->address }}"  placeholder="Address">
							<input type="text" name="city" id="city" value="{{ $userDetails->city }}"  placeholder="City">
							<input type="text" name="state" id="state" value="{{ $userDetails->state }}"  placeholder="State">
							<select name="country" id="country">
								@foreach($country as $co)
									<option value="{{ $co->country_name }}" @if($co->country_name==$userDetails->country) selected @endif>{{ $co->country_name }}</option>
								@endforeach
							</select>
							<input style="margin-top: 10px" type="text" name="pincode" id="pincode" value="{{ $userDetails->pincode }}"  placeholder="Pincode">
							<input type="text" name="mobile" id="mobile" value="{{ $userDetails->mobile }}"  placeholder="Mobile No.">
							<button type="submit" class="btn btn-primary">Update</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>Update Password</h2>
						<form name="passwordForm" action="{{ url('/update_user_pwd') }}" id="passwordForm" method="post">{{ csrf_field() }}
							<input type="password" name="new_pwd" id="new_pwd" placeholder="New Password">
							<input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password">
							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection