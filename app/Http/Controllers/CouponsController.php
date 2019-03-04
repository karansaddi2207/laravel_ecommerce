<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
    public function add_coupon(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		//echo "<pre>";print_r($data);die;
    		if(empty($data['status']))
    		{
    			$status = '0';
    		}
    		else
    		{
    			$status = $data['status'];
    		}
    		$coupon = new Coupon;
    		$coupon->coupon_code = $data['coupon_code'];
    		$coupon->amount = $data['amount'];
    		$coupon->amount_type = $data['amount_type'];
    		$coupon->expiry_date = $data['expiry_date'];
    		$coupon->status = $status;
    		$coupon->save();
    		return redirect('/admin/add_coupon')->with('flash_message_success','Data inserted successfully');
    	}
    	return view('admin.coupons/add_coupon');
    }

    public function view_coupon()
    {
    	$coupons = Coupon::get();
    	return view('admin.coupons.view_coupon')->with(compact('coupons'));
    }

    public function edit_coupons(Request $request,$id=null)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		if(empty($data['status']))
    		{
    			$status = 0;
    		}
    		else
    		{
    			$status = 1;
    		}
    		//dd($data);
    		$coupon = Coupon::where('id',$id)->update(['coupon_code'=>$data['coupon_code'],'amount'=>$data['amount'],'amount_type'=>$data['amount_type'],'expiry_date'=>$data['expiry_date'],'status'=>$status]);
    		return redirect()->action('CouponsController@view_coupon')->with('flash_message_success','Coupon updated successfully!');
    	}

    	$couponDetails = Coupon::find($id);
    	//$couponDetails = json_decode(json_encode($couponDetails));
    	//dd($couponDetails);
    	return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }

    public function delete_coupons($id=null)
    {
    	Coupon::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Coupon has been deleted successfully!');
    }

}
