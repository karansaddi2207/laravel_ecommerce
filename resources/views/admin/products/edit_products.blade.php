@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Edit Products</a> </div>
    <h1>Products validation</h1>
    @if(Session::has('flash_message_success'))
      <div class="alert alert-block alert-error">
        {!! session('flash_message_success') !!}
      </div>
    @endif
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Products</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit_products/'.$productDetails->id) }}" name="add_products" id="edit_products" novalidate="novalidate">{{ csrf_field() }}
              
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{ $productDetails->product_name }}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Under Category</label>
                <div class="controls">
                  <select name="category_id" id="category_id" style="width: 220px">
                    @php
                      echo $categories_dropdown
                    @endphp
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{ $productDetails->product_code }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{ $productDetails->product_color }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description"">{{ $productDetails->description }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Care and Material</label>
                <div class="controls">
                  <textarea name="care" id="care"">{{ $productDetails->care }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Price</label>
                <div class="controls">
                  <input type="text" name="product_price" id="product_price" value="{{ $productDetails->price }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Images</label>
                <div class="controls">
                  <input type="hidden" name="current_image" value="{{ $productDetails->image }}">
                  <input type="file" name="image" id="image" value="{{ $productDetails->image }}">
                  @if(!empty($productDetails->image))
                  <img src="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}" height="50px" width="50px"> | <a href="{{ url('/admin/delete_product_images/'.$productDetails->id) }}">Delete</a>
                  @endif
                  
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($productDetails->status=="1") checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection