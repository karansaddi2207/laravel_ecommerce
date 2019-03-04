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
			
		</div>
	</section> 

	<section id="do_action">
		<div class="container">
			<div class="heading" style="text-align: center">
				<h3>Your Paypal order has been placed successfully.</h3>
				<p>Thanks for the payment. We will process your order soon.</p>
				<p>Your order number is : {{Session::get('order_id')}} and paid amount is : {{Session::get('grand_total')}} </p>
			</div>
		</div>
	</section><!--/#do_action-->	

@endsection

<?php

Session::forget('grand_total');
Session::forget('order_id');

?>