@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Products</a> </div>
    <h1>Products validation</h1>
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
            <h5>Adds Product Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add_attributes/'.$productDetails->id) }}" name="add_attributes" id="add_attributes" novalidate="novalidate">{{ csrf_field() }}
            	
              <div class="control-group">

                <label class="control-label">Product Name</label>
                <label class="control-label">{{ $productDetails->product_name }}</label>
              </div>

              
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label">{{ $productDetails->product_code }}</label>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
                <label class="control-label">{{ $productDetails->product_color }}</label>
              </div>
              <div class="control-group">
              	<label class="control-label"></label>
              	<div class="field_wrapper">
				    <div>
				        <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px" />
				        <input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px">
				        <input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px">
				        <input type="text" name="stock[]" id="stock" placeholder="stock" style="width: 120px">
				        <a href="javascript:void(0)" class="add_button" title="Add field">Add</a>
				    </div>
				</div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Attributes" class="btn btn-success">
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
            <form action="{{ url('/admin/edit_attributes/'.$productDetails->id) }}" method="post">{{ csrf_field() }}
              <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Attribute ID</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
              	@foreach($productDetails['attributes'] as $attribute)
              	
                <tr class="gradeX">
                  <td><input type="hidden" name="idAttr[]" value="{{ $attribute->id }}">{{ $attribute->id }}</td>
                  <td>{{ $attribute->sku }}</td>
                  <td>{{ $attribute->size }}</td>
                  <td><input type="text" name="price[]" value="{{ $attribute->price }}"></td>
                  <td><input type="text" name="stock[]" value="{{ $attribute->stock }}"></td>
                  <td class="center">
                    <input type="submit" value="Update" class="btn btn-primary btn-mini">
                    <a href="{{ url('/admin/delete_attribute/'.$attribute->id) }}" class="btn btn-mini btn-danger" id="deleteRecord">Delete</a>
                  </td>
                </tr>
	            @endforeach
	           </tbody>
	    	      </table>
            </form>
	       </div>

	 	</div>
  	  </div>
	</div>
<script src="{{ asset('js/backend_js/jquery.min.js') }}"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
       var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-left:180px"><input type="text" name="sku[]" style="width:120px;margin-top:5px;margin-right:5px" id="sku" placehoder="SKU"><input type="text" name="size[]" id="size" placehoder="Size" style="width:120px;margin-top:5px;margin-right:5px"><input type="text" name="price[]" id="price" style="width:120px;margin-top:5px;margin-right:5px" placehoder="Price"><input type="text" style="width:120px;margin-top:5px;margin-right:5px" name="stock[]" id="stock" placehoder="Stock"><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_button').click(function(){
      //alert('dsfdsf');
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    });

   
  </script>



@endsection