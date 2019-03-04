<!--sidebar-menu-->
@php
  $url = url()->current();
@endphp
<div id="sidebar"><a href="{{ url('/admin/dashboard') }}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li @if(preg_match("/dashboard/i",$url)) class="active" @endif><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="javascript:void(0)"><i class="icon icon-th-list"></i> <span>Category</span> <span class="label label-important">3</span></a>
      <ul @if(preg_match("/categor/i",$url)) style="display: block;" @endif>
        <li @if(preg_match("/add_category/i",$url)) class="active" @endif><a href="{{ url('/admin/add_category') }}">Add Category</a></li>
        <li @if(preg_match("/view_categories/i",$url)) class="active" @endif><a href="{{ url('/admin/view_categories') }}">View Categories</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="javascript:void(0)"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">3</span></a>
      <ul @if(preg_match("/products/i",$url)) style="display: block;" @endif>
        <li @if(preg_match("/add_products/i",$url)) class="active" @endif><a href="{{ url('/admin/add_products') }}">Add Products</a></li>
        <li @if(preg_match("/view_products/i",$url)) class="active" @endif><a href="{{ url('/admin/view_products') }}">View Products</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="javascript:void(0)"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">3</span></a>
      <ul @if(preg_match("/coupon/i",$url)) style="display: block;" @endif>
        <li @if(preg_match("/add_coupon/i",$url)) class="active" @endif><a href="{{ url('/admin/add_coupon') }}">Add Coupons</a></li>
        <li @if(preg_match("/view_coupon/i",$url)) class="active" @endif><a href="{{ url('/admin/view_coupon') }}">View Coupons</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="javascript:void(0)"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">3</span></a>
      <ul @if(preg_match("/banner/i",$url)) style="display: block;" @endif>
        <li @if(preg_match("/add_banner/i",$url)) class="active" @endif><a href="{{ url('/admin/add_banner') }}">Add Banners</a></li>
        <li @if(preg_match("/view_banner/i",$url)) class="active" @endif><a href="{{ url('/admin/view_banner') }}">View Banners</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="form-common.html">Basic Form</a></li>
        <li><a href="form-validation.html">Form with Validation</a></li>
        <li><a href="form-wizard.html">Form with Wizard</a></li>
      </ul>
    </li>
    <li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>
    <li> <a href="widgets.html"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>
    <li><a href="tables.html"><i class="icon icon-th"></i> <span>Tables</span></a></li>
    <li><a href="grid.html"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="form-common.html">Basic Form</a></li>
        <li><a href="form-validation.html">Form with Validation</a></li>
        <li><a href="form-wizard.html">Form with Wizard</a></li>
      </ul>
    </li>
    <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
    <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="index2.html">Dashboard2</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="invoice.html">Invoice</a></li>
        <li><a href="chat.html">Chat option</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="error403.html">Error 403</a></li>
        <li><a href="error404.html">Error 404</a></li>
        <li><a href="error405.html">Error 405</a></li>
        <li><a href="error500.html">Error 500</a></li>
      </ul>
    </li>
    <li class="content"> <span>Monthly Bandwidth Transfer</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: 77%;" class="bar"></div>
      </div>
      <span class="percent">77%</span>
      <div class="stat">21419.94 / 14000 MB</div>
    </li>
    <li class="content"> <span>Disk Space Usage</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: 87%;" class="bar"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">604.44 / 4000 MB</div>
    </li>
  </ul>
</div>
<!--sidebar-menu-->