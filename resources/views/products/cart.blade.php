@extends('layouts.frontLayout.front_design')


@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				@if(Session::has('flash_message_success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">x</button>
						{{ session('flash_message_success') }}
					</div>
				@endif
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
							$total_amount = 0;
						@endphp
						@if(count($userCart)==0)
						<tr>
							<td><h2>Nothing is in your cart</h2></td>
						</tr>
						@endif
						@foreach($userCart as $cart)
						<tr>
							<td class="cart_product">
								<a href="javascript:void(0)"><img src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt="" height="50px" width="50px"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $cart->product_name }}</a></h4>
								<p>{{ $cart->product_code }} | {{ $cart->size }}</p>
							</td>
							<td class="cart_price">
								<p>INR {{ $cart->price }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{ url('/cart/update_quantity/'.$cart->id.'/1') }}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
									@if($cart->quantity>1)
									<a class="cart_quantity_down" href="{{ url('/cart/update_quantity/'.$cart->id.'/-1') }}"> - </a>
									@endif
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">INR {{ $cart->price*$cart->quantity }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ url('/cart/delete_cart_product/'.$cart->id) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@php
							$total_amount = $total_amount + ($cart->price*$cart->quantity);
						@endphp
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code you want to us.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<form action="{{ url('/cart/apply_coupon') }}" method="post">{{ csrf_field() }}
									<label>Use Coupon Code</label>
									<input type="text" name="coupon_code">
									<input type="submit" value="Apply" class="btn btn-default">
								</form>
							</li>
						</ul>
						
						
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							@if(!empty(Session::get('CouponAmount')))
								<li>Sub Total <span>INR {{ $total_amount }} </span></li>
								<li>Coupon Discount <span>INR {{ session('CouponAmount') }} </span></li>
								<li>Grand Total <span>INR {{ $total_amount-session('CouponAmount') }} </span></li>
							@else
								<li>Total <span>INR {{ $total_amount }}</span></li>
							@endif
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a href="{{ url('/checkout') }}" class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->	

@endsection