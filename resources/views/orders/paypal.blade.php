@extends('layouts.frontLayout.front_design')


@section('content')
<?php use App\Order; ?>
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
				<h3>Your COD order has been placed.</h3>
				<p>Your order number is : {{Session::get('order_id')}} and payable amount is : {{Session::get('grand_total')}} </p>
				<p>Pleaes make payment by clicking below payment button</p>
				<?php

				$orderDetails = Order::getOrderDetails(Session::get('order_id'));
				//echo "<pre>";print_r($orderDetails);die;

				$getCountry = Order::getCountryCode($orderDetails->country);

				?>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				  <input type="hidden" name="cmd" value="_xclick">
				  <input type="hidden" name="business" value="businesslaravel@gmail.com">
				  <input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
				  <input type="hidden" name="item_number" value="{{Session::get('order_id')}}">
				  <input type="hidden" name="amount" value="{{Session::get('grand_total')}}">
				  <input type="hidden" name="currency_code" value="INR">
				  <input type="hidden" name="return" value="http://localhost:8000/thanks_paypal">
				  <input type="hidden" name="cancel_return" value="http://localhost:8000/paypal_cancel">
				  <input type="image" name="submit"
				    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
				    alt="PayPal - The safer, easier way to pay online">
				</form>
			</div>
		</div>
	</section><!--/#do_action-->	

@endsection

<?php

//Session::forget('grand_total');
//Session::forget('order_id');

?>