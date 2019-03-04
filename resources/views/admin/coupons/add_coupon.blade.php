@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Coupons</a> </div>
    <h1>Coupons validation</h1>
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
            <h5>Adds Coupon</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add_coupon') }}" name="add_coupons" id="add_coupons">{{ csrf_field() }}
              
              <div class="control-group">
                <label class="control-label">Coupon Code</label>
                <div class="controls">
                  <input type="text" name="coupon_code" id="coupon_code" minlength="5" maxlength="15">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Amount Type</label>
                <div class="controls">
                  <select name="amount_type" id="amount_type" style="width: 220px">
                    <option value="Percentage">Percentage</option>
                    <option value="Fixed">Fixed</option>
                  </select>
                </div>
              </div>
              
             
              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="text" name="amount" id="amount">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Expiry Date</label>
                <div class="controls">
                  <input type="date" name="expiry_date" id="expiry_date">
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Coupon" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
      $(document).ready(function(){
        alert('dsklfjkdslf');
       
      });
</script>
@endsection