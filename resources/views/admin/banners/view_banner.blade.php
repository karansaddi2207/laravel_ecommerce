@extends('layouts.adminLayout.admin_design')

@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Banners</a> </div>
    <h1>Banners</h1>
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
            <h5>View Banners</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Banner ID</th>
                  <th>Banner Title</th>
                  <th>Banner Link</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php 
                     $i = 1
                @endphp
                @foreach($banners as $banner)
                
                <tr class="gradeX">
                  <td>{{ $i }}</td>
                  <td>{{ $banner->title }}</td>
                  <td>{{ $banner->link }}</td>
                  <td>{{ $banner->status }}</td>
                  <td>
                    @if(!empty($banner->image))
                    <img src="{{ asset('/images/frontend_images/banners/'.$banner->image) }}" height="200px" width="100px">
                    @endif
                  </td>
                  <td class="center">
                    <a href="{{ url('admin/edit_banner/'.$banner->id) }}" class="btn btn-primary btn-mini">Edit </a>
                    <a href="{{ url('admin/delete_banner/'.$banner->id) }}" class="btn btn-mini btn-danger" id="delProduct">Delete</a>
                  </td>
                </tr>

                @php
                  $i++
                @endphp

              
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