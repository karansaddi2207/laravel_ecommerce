@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Banners</a> </div>
    <h1>Edit Banners validation</h1>
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
            <h5>Edit Banner</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit_banner/'.$banner_details->id) }}" name="edit_banner" id="edit_banner">{{ csrf_field() }}
              
              <div class="control-group">
                <label class="control-label">Banner Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image" value="dsf">
                  <input type="hidden" name="current_image" value="{{ $banner_details->image }}">
                </div>
              </div>

             
              <div class="control-group">
                <label class="control-label">Banner Title</label>
                <div class="controls">
                  <input type="text" name="banner_title" id="banner_title" value="{{ $banner_details->title }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Link</label>
                <div class="controls">
                  <input type="text" name="link" id="link" value="{{ $banner_details->link }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($banner_details->status==1) checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Banner" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection