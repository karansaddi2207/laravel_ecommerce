<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orders()
    {
    	return $this->hasMany('App\ordersProduct','order_id');
    }

    public static function getOrderDetails($order_id)
    {
    	$getOrderDetails = Order::where('id',$order_id)->first();
    	return $getOrderDetails;
    }

    public static function getCountryCode($country_name)
    {
    	$getCountryCode = Country::where('country_name',$country_name)->first();
    	return $getCountryCode;
    }
}
