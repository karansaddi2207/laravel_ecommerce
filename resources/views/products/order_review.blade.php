@extends('layouts.frontLayout.front_design')

@section('content')
	


<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">
					
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Billing Details</h2>
						<div class="form-group">
							{{ $userDetails->name }}
						</div>
						<div class="form-group">
							{{ $userDetails->address }}
						</div>
						<div class="form-group">
							{{ $userDetails->city }}
						</div>
						<div class="form-group">
							{{ $userDetails->state }}
						</div>
						<div class="form-group">
							{{ $userDetails->country }}
						</div>
						<div class="form-group">
							{{ $userDetails->pincode }}
						</div>
						<div class="form-group">
							{{ $userDetails->mobile }}
						</div>
									
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">And</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Shipping Details</h2>
						<div class="form-group">
							{{ $shippingDetails->name }}
						</div>
						<div class="form-group">
							{{ $shippingDetails->address }}
						</div>
						<div class="form-group">
							{{ $shippingDetails->city }}
						</div>
						<div class="form-group">
							{{ $shippingDetails->state }}
						</div>
						<div class="form-group">
							{{ $shippingDetails->country }}
						</div>
						<div class="form-group">
							{{ $shippingDetails->pincode }}
						</div>
						<div class="form-group">
							{{ $shippingDetails->mobile }}
						</div>
								
					</div><!--/sign up form-->
				</div>
			</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
							$totalAmount = 0;
						@endphp
						@foreach($userCart as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt="" height="50px" width="50px"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $cart->product_name }}</a></h4>
								<p>Code: {{ $cart->product_code }}</p>
							</td>
							<td class="cart_price">
								<p>INR {{ $cart->price }}</p>
							</td>
							<td class="cart_price">
									<p class="cart_total_price">{{ $cart->quantity }}</p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{ $cart->quantity * $cart->price }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@php
							$totalAmount = $totalAmount + ($cart->quantity * $cart->price);
						@endphp
						@endforeach
						
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>INR {{ $totalAmount }}</td>
									</tr>
									<tr>
										<td>Shipping Cost</td>
										<td>Free</td>
									</tr>
									<tr class="shipping-cost">
										<td>Discount Cost</td>
										@if(Session::has('CouponAmount'))
										<td>INR {{ Session::get('CouponAmount') }}</td>
										@else
										<td>0</td>
										@endif									
									</tr>
									
									<tr>
										<td>Total</td>
										<td><span>INR {{ $grand_total = $totalAmount - Session::get('CouponAmount') }}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<form method="post" action="{{ url('/place_order') }}" id="paymentForm" name="paymentForm">{{ csrf_field() }}
				<input type="hidden" name="grand_total" value="{{ $grand_total }}">
				<div class="payment-options">
					<span>
						<label><strong>Select Payment Method :</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="COD" value="Cash On Delivery"><strong> Cash On Delivery (COD)</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" value="Paypal" id="Paypal"><strong> Paypal</strong></label>
					</span>
					<span style="float: right">
						<button type="submit" class="btn btn-default" onclick="return selectPaymentMehtod()">Place Order</button>
					</span>
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection