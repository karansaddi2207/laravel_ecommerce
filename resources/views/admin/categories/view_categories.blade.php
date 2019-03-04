@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Categories</a> </div>
    <h1>Categories</h1>
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
            <h5>View Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Category Lavel</th>
                  <th>URL</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@php 
              	     $i = 1
              	@endphp
              	@foreach($categories as $category)
              	
                <tr class="gradeX">
                  <td>{{ $i }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->parent_id }}</td>
                  <td>{{ $category->url }}</td>
                  <td class="center"><a href="{{ url('admin/edit_categories/'.$category->id) }}" class="btn btn-primary btn-mini">Edit </a> <a href="{{ url('admin/delete_categories/'.$category->id) }}" class="btn btn-mini btn-danger" id="delCat">Delete</a></td>
                </tr>
                @php
                	$i++
                @endphp
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