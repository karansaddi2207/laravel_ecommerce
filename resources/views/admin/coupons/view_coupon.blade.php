@extends('layouts.adminLayout.admin_design')

@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Coupons</a> </div>
    <h1>Coupons</h1>
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
            <h5>View Coupons</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Coupon ID</th>
                  <th>Coupon Code</th>
                  <th>Amount</th>
                  <th>Amount Type</th>
                  <th>Expiry Date</th>
                  <th>Created Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php 
                     $i = 1
                @endphp
                @foreach($coupons as $coupon)
                
                <tr class="gradeX">
                  <td>{{ $i }}</td>
                  <td>{{ $coupon->coupon_code }}</td>
                  <td>{{ $coupon->amount }}</td>
                  <td>{{ $coupon->amount_type }}</td>
                  <td>{{ $coupon->expiry_date }}</td>
                  <td>{{ $coupon->created_at }}</td>
                  <td>
                    @if($coupon->status==1)
                      Active
                    @else
                      Expired
                    @endif
                  </td>           
                  <td class="center">
                   
                    <a href="{{ url('admin/edit_coupons/'.$coupon->id) }}" class="btn btn-primary btn-mini">Edit </a>
                    
                   
                    <a href="{{ url('admin/delete_coupons/'.$coupon->id) }}" class="btn btn-mini btn-danger" id="delCoupon">Delete</a>
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