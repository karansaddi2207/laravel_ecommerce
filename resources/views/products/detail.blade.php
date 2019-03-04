@extends('layouts.frontLayout.front_design');

@section('content')
<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('layouts.frontLayout.front_sidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--adjacent">
									<a href="{{ asset('images/backend_images/products/large/'.$productDetails->image) }}">
										<img class="mainImage" src="{{ asset('images/backend_images/products/small/'.$productDetails->image) }}" style="cursor: pointer;width:300px" alt="" />
									</a>
								</div>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="item active thumbnails">
										@foreach($productAltImages as $img)
										<a href="{{ asset('images/backend_images/products/small/'.$img->image) }}" data-standard="{{ asset('images/backend_images/products/small/'.$img->image) }}">
											<img style="cursor: pointer" class="changeImage" src="{{ asset('images/backend_images/products/small/'.$img->image) }}" width="50px" height="50px">
										</a>
										@endforeach
									</div>
								</div>
								 
							</div>

						</div>
						<div class="col-sm-7">
							<form name="addToCartForm" id="addToCartForm" action="{{ url('add_cart') }}" method="post">{{ csrf_field() }}
								<input type="hidden" name="product_id" value="{{ $productDetails->id }}">
								<input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
								<input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
								<input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
								<input type="hidden" name="product_price" id="product_price" value="{{ $productDetails->price }}">
								<div class="product-information"><!--/product-information-->
									
									<h2>{{ $productDetails->product_name }}</h2>
									<p>Code: {{ $productDetails->product_code }}</p>
									<p>
										<select name="size" id="selSize">
											<option selected disabled>Select Size</option>
											@foreach($productDetails->attributes as $sizes)
												<option value="{{ $productDetails->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
											@endforeach
										</select>
									</p>
									<span>
										<span id="get_price">INR $ {{ $productDetails->price }}</span>
										<label>Quantity:</label>
										<input type="text" value="1" name="quantity" />
										@if($totalStock>0)
										<button type="submit " class="btn btn-fefault cart" id="cartButton">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
										</button>
										@endif
									</span>
									<p><b>Availability:</b><span id="Availability">@if($totalStock>0) In Stock @else Out Of Stock @endif</p>
									<p><b>Condition:</b> New</p></span>
									
									<a href=""></a>
								</div><!--/product-information-->
							</form>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material &amp; Care</a></li>
								<li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="description" >
								<div class="col-sm-12">
									<p>
										{{ $productDetails->description }}
									</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="care" >
								<div class="col-sm-12">
									<p>
										{{ $productDetails->care }}
									</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="delivery" >
								<div class="col-sm-12">
									<p>
										With in the 3 business days.
									</p>
								</div>
							</div>
							
							
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								@php 
									$count = 1;
								@endphp
								@foreach($relatedProducts->chunk(3) as $chunk)
								<div <?php if($count==1){ ?> class="item active" <?php } else{ ?> class="item" <?php } ?>>
									@foreach($chunk as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ asset('images/backend_images/products/small/'.$item->image) }}" alt="" height="200px" width="100px" />
													<h2>INR {{ $item->price }}</h2>
													<p>{{ $item->product_name }}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								@php
									$count++;
								@endphp
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
@endsection

<script>
		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();
/*
		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});*/
	</script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>