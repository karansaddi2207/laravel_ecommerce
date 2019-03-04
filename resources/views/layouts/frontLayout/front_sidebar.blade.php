<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian">
							@foreach($categories as $cat)
							@if($cat->status==1)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{ $cat->url }}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{ $cat->name }}
										</a>
									</h4>
								</div>
								<div id="{{ $cat->url }}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach($cat->categories as $sub_cat)
											@if($sub_cat->status==1)
											<li><a href="{{ url('products/'.$sub_cat->url) }}">{{ $sub_cat->name }}</a></li>
											@endif
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endif
							@endforeach

						</div><!--/category-products-->
					</div>