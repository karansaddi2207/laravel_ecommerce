@extends('layouts.frontLayout.front_design')

@section('content')



<section id="form" style="margin-top: 10px"><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<form action="{{ url('/checkout') }}" id="checkoutForm" method="post">{{ csrf_field() }}
				<div class="row">
					@if(Session::has('flash_message_success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">x</button>
						{{ session('flash_message_success') }}
					</div>
					@endif
						<div class="col-sm-4 col-sm-offset-1">
							<div class="login-form"><!--login form-->
								<h2>Bill To</h2>
									<div class="form-group">
										<input type="text" name="billing_name" id="billing_name" placeholder="Name" class="form-control" disabled value="{{ $userDetails->name }}" />
									</div>
									<div class="form-group">
										<input type="text" name="billing_address" disabled id="billing_address" placeholder="Address" class="form-control" value="{{ $userDetails->address }}" />
									</div>
									<div class="form-group">
										<input type="text" name="billing_city" disabled id="billing_city" placeholder="City" class="form-control" value="{{ $userDetails->city }}" />
									</div>
									<div class="form-group">
										<input type="text" name="billing_state" disabled id="billing_state" placeholder="State" class="form-control" value="{{ $userDetails->state }}" />
									</div>
									<div class="form-group">
										<select name="billing_country" disabled id="billing_country">
										@foreach($countries as $country)
											<option value="{{ $country->country_name }}" @if($country->country_name==$userDetails->country) selected @endif>{{ $country->country_name }}</option>
										@endforeach
										</select>
									</div>
									<div class="form-group">
										<input type="text" name="billing_pincode" disabled id="billing_pincode" placeholder="Pincode" class="form-control" value="{{ $userDetails->pincode }}" />
									</div>
									<div class="form-group">
										<input type="text" name="billing_mobile" disabled id="billing_mobile" placeholder="Mobile" class="form-control" value="{{ $userDetails->mobile }}" />
									</div>
									<!-- Material unchecked -->
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="billtoship">
									    <label class="form-check-label" for="materialUnchecked">Shipping Address Same As Billing Address</label>
									</div>
							</div><!--/login form-->
						</div>
						<div class="col-sm-1">
							<h2 class="or">OR</h2>
						</div>
						<div class="col-sm-4">
							<div class="signup-form"><!--sign up form-->
								<h2>Ship To</h2>
									<div class="form-group">
										<input type="text" id="shipping_name" name="shipping_name" placeholder="Shipping Name" class="form-control" />
									</div>
									<div class="form-group">
										<input type="text" id="shipping_address" name="shipping_address" placeholder="Shipping Address" class="form-control" />
									</div>
									<div class="form-group">
										<input type="text" id="shipping_city" name="shipping_city" placeholder="Shipping City" class="form-control" />
									</div>
									<div class="form-group">
										<input type="text" id="shipping_state" name="shipping_state" placeholder="Shipping State" class="form-control" />
									</div>
									<div class="form-group">
										<select name="shipping_country" id="shipping_country">
										@foreach($countries as $country)
											<option value="{{ $country->country_name }}" @if($country->country_name==$userDetails->country) selected @endif>{{ $country->country_name }}</option>
										@endforeach
										</select>
									</div>
									<div class="form-group">
										<input type="text" id="shipping_pincode" name="shipping_pincode" placeholder="Shipping Pincode" class="form-control" />
									</div>
									<div class="form-group">
										<input type="text id" id="shipping_mobile" name="shipping_mobile" placeholder="Shipping Mobile" class="form-control" />
									</div>
									<button type="submit" class="btn btn-default" />Checkout</button>
								
							</div><!--/sign up form-->
						</div>
				</div>
			</form>
		</div>
</section><!--/form-->

@endsection