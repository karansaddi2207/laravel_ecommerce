@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Images</a> </div>
    <h1>Image validation</h1>
    @if(Session::has('flash_message_success'))
    	<div class="alert alert-block alert-error">
    		{!! session('flash_message_success') !!}
    	</div>
    @endif
    @if(Session::has('flash_message_error'))
      <div class="alert alert-block alert-error">
        {!! session('flash_message_error') !!}
      </div>
    @endif
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Alernate Product Image</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add_images/'.$productDetails->id) }}" name="add_images" id="add_images" novalidate="novalidate">{{ csrf_field() }}
            	
              <div class="control-group">

                <label class="control-label">Product Name</label>
                <label class="control-label">{{ $productDetails->product_name }}</label>
              </div>

              
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label">{{ $productDetails->product_code }}</label>
              </div>
              <div class="control-group">
                <label class="control-label">Product Images</label>
                <div class="controls">
                  <input type="file" name="image[]" id="image" multiple="multiple">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Images" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Image ID</th>
                  <th>Product ID</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                
              </thead>
              <tbody>
                @foreach($productsImages as $image)
              	<tr>
                  <td>{{ $image->id }}</td>
                  <td>{{ $image->product_id }}</td>
                  <td><img src="{{ asset('images/backend_images/products/small/'.$image->image) }}" height="50px" width="50px"></td>
                  <td><a href="{{ url('admin/delete_alternate_images/'.$image->id) }}">Delete</a> </td>
                </tr>
                @endforeach
	           </tbody>
	    	</table>
	       </div>

	 	</div>
  	  </div>
	</div>



@endsection