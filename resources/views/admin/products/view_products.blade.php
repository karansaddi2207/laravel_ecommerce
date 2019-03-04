@extends('layouts.adminLayout.admin_design')

@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Products</a> </div>
    <h1>Products</h1>
    @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block">
        {!! session('flash_message_error') !!}
      </div>
    @endif
    @if(Session::has('flash_message_success'))
      <div class="alert alert-error alert-block">
        {!! session('flash_message_success') !!}
      </div>
    @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Products ID</th>
                  <th>Product Name</th>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Products Code</th>
                  <th>Products Color</th>
                  <th>Price</th>
                  <th>Images</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@php 
              	     $i = 1
              	@endphp
              	@foreach($products as $product)
              	
                <tr class="gradeX">
                  <td>{{ $i }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->category_id }}</td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>{{ $product->price }}</td>
                  <td>
                  	@if(!empty($product->image))
                  	<img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" height="50px" width="50px">
                  	@endif
                  </td>
                  <td class="center">
                    <a href="#myModal{{$product->id}}" class="btn btn-warning btn-mini" data-toggle="modal">View </a>
                    <a href="{{ url('admin/edit_products/'.$product->id) }}" class="btn btn-primary btn-mini">Edit </a>
                    <a href="{{ url('admin/add_attributes/'.$product->id) }}" class="btn btn-warning btn-mini" title="Add Attributes">Add </a>
                    <a href="{{ url('admin/add_images/'.$product->id) }}" class="btn btn-info btn-mini" title="Add Images">Add Images</a>
                    <a href="{{ url('admin/delete_products/'.$product->id) }}" class="btn btn-mini btn-danger" id="delProduct">Delete</a>
                  </td>
                </tr>

                @php
                	$i++
                @endphp

	            <div id="myModal{{$product->id}}" class="modal hide">
	              <div class="modal-header">
	                <button data-dismiss="modal" class="close" type="button">×</button>
	                <h3>{{$product->product_name}} 's Full Description</h3>
	              </div>
	              <div class="modal-body">
	                <p>ProductID : {{ $product->id }}</p>
	                <p>Product Name : {{ $product->product_name }}</p>
	                <p>Product Code : {{ $product->product_code }}</p>
	                <p>Product Color : {{ $product->product_color }}</p>
	                <p>Product Price : {{ $product->price }}</p>
	                <p>Product Category : {{ $product->category_name }}</p>
	              </div>
	            </div>
              <!--</tbody></table></div></div></div></div></div></div> -->
</div>

                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection