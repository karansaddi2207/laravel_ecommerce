<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use Auth;
use Session;
use Image;
use DB;
use App\ProductsImage;
use App\Coupon;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;

class ProductController extends Controller
{
    public function add_products(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		//dd($data);
    		$product = new Product;
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->product_color = $data['product_color'];
    		$product->product_code = $data['product_code'];
    		$product->price = $data['product_price'];
            $product->care = $data['care'];
    		$product->description = $data['description'];

    		//upload images
    		if($request->hasFile('image'))
    		{
    			$image_tmp = Input::file('image');
    			if($image_tmp->isValid())
    			{
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$larger_image_path = 'images/backend_images/products/large/'.$filename;
    				$medium_image_path = 'images/backend_images/products/medium/'.$filename;
    				$small_image_path = 'images/backend_images/products/small/'.$filename;
    				//resize images
    				Image::make($image_tmp)->save($larger_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    				$product->image = $filename;
    			}
    		}

            if(empty($data['status']))
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }

            $product->status = $status;
    		$product->save();
    		return redirect()->back()->with('flash_message_success','Product has been added successfully');
    		//$product->image = $data['image'];
    	}

    	//categories dropdown start
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach($categories as $cat)
    	{
    		$categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach($sub_categories as $sub_cat)
    		{
    			$categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;&nbsp;--&nbsp;&nbsp;".$sub_cat->name."</option>";
    		}
    	}
    	//categories dropdown end
    	//dd($categories_dropdown);
    	return view('admin.products.add_products')->with(compact('categories_dropdown'));
    }

    public function view_products(Request $request)
    {
    	$products = Product::OrderBy('id','DESC')->get();
    	$products = json_decode(json_encode($products));
        //echo "<pre>";
        //print_r($products);die;
    	foreach($products as $key => $value)
    	{
    		$category_name = Category::where(['id'=>$value->category_id])->first();
    		$products[$key]->category_name = $category_name->name;
    	}
    	//echo "<pre>";
    	//print_r($products);
    	//echo "</pre>";die;
    	return view('admin.products.view_products')->with(compact('products'));
    }

    public function edit_products(Request $request, $id=null)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		//dd($data);
    		if($request->hasFile('image'))
    		{
    			$image_tmp = Input::file('image');
    			if($image_tmp->isValid())
    			{
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$larger_image_path = 'images/backend_images/products/large/'.$filename;
    				$medium_image_path = 'images/backend_images/products/medium/'.$filename;
    				$small_image_path = 'images/backend_images/products/small/'.$filename;
    				//resize images
    				Image::make($image_tmp)->save($larger_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    			}
    		}
    		else
    		{
    			$filename = $data['current_image'];
    		}


            if(empty($data['status']))
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }
    		
    		Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['product_price'],'image'=>$filename,'status'=>$status]);
    		return redirect()->back()->with('flash_message_success','Product has been updated successfully');
    	}
    	$productDetails = Product::where(['id'=>$id])->first();
    	//categories dropdown start
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach($categories as $cat)
    	{
    		if($cat->id == $productDetails->category_id)
    		{
    			$selected = 'selected';
    		}
    		else
    		{
    			$selected = '';
    		}
    		$categories_dropdown .= "<option value='".$cat->id."'".$selected.">".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach($sub_categories as $sub_cat)
    		{
    			$categories_dropdown .= "<option value='".$sub_cat->id."'".$selected.">&nbsp;&nbsp;--&nbsp;&nbsp;".$sub_cat->name."</option>";
    		}
    	}
    	//categories dropdown end
    	return view('admin.products.edit_products')->with(compact('productDetails','categories_dropdown'));
    }

    public function delete_product_images($id=null)
    {
        //for deleting images from folder as well
        $productImage = Product::where(['id'=>$id])->first();

        $larger_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        if(file_exists($larger_image_path.$productImage->image))
        {
            unlink($larger_image_path.$productImage->image);
        }

        if(file_exists($medium_image_path.$productImage->image))
        {
            unlink($medium_image_path.$productImage->image);
        }

        if(file_exists($small_image_path.$productImage->image))
        {
            unlink($small_image_path.$productImage->image);
        }

        //deleting images from database
    	Product::where(['id'=>$id])->update(['image'=>'']);
    	return redirect()->back()->with('flash_message_success','Product image has been deleted successfully');
    }

    public function delete_products($id=null)
    {
    	Product::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Product has been deleted successfully');
    }

    public function add_attributes(Request $request,$id=null)
    {
    	$productDetails = Product::with('attributes')->where(['id'=>$id])->first();
    	//$productDetails = json_decode(json_encode($productDetails));
    	//echo "<pre>";
    	//	print_r($productDetails);
    	//echo "</pre>";die;
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();//echo "<pre>";
    		//print_r($data);die;
    		foreach($data['sku'] as $key=>$val)
    		{
    			//dd($key);
    			if(!empty($val))
    			{
                    $attrCountSku = ProductsAttribute::where('sku',$val)->count();
                    if($attrCountSku>0)
                    {
                        return redirect('/admin/add_attributes/'.$id)->with('flash_message_error','SKU is already exists, please write another SKU!');
                    }

                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSize>0)
                    {  
                        return redirect('/admin/add_attributes/'.$id)->with('flash_message_error','Product with this size is already exists, please write another Size!');
                    }
    				$attribute = new ProductsAttribute;
    				$attribute->product_id = $id;
    				$attribute->sku = $val;
    				$attribute->size = $data['size'][$key];
    				$attribute->price = $data['price'][$key];
    				$attribute->stock = $data['stock'][$key];
    				$attribute->save();
    			}
    		}
    		return redirect('/admin/add_attributes/'.$id)->with('flash_message_success','Products attribute has been added successfully');
    	}
    	return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    public function add_images(Request $request,$id=null)
    {
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        if($request->isMethod('post'))
        {
            //add images
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            if($request->hasFile('image'))
            {
                $files = $request->file('image');
                //upload images after resize
                foreach($files as $file)
                {
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).".".$extension;

                    $larger_image_path = 'images/backend_images/products/large/'.$fileName;
                    $medium_image_path = 'images/backend_images/products/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/small/'.$fileName;

                    Image::make($file)->save($larger_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);

                    //save in database
                    $image->image = $fileName;
                    $image->product_id = $id;
                    $image->save();
                }
                
            }
            return redirect('admin/add_images/'.$id)->with('flash_message_success','Images added successfully!');
        }

        $productsImages = ProductsImage::where(['product_id'=>$id])->get();
        //$productsImages = json_decode(json_encode($productsImages));
        //echo "<pre>";print_r($productsImages);die;
        return view('admin.products.add_images')->with(compact('productDetails','productsImages'));
    }

    public function delete_alternate_images($id=null)
    {
        $productImage = ProductsImage::where(['id'=>$id])->first();

        $larger_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        if(file_exists($larger_image_path.$productImage->image))
        {
            unlink($larger_image_path.$productImage->image);
        }

        if(file_exists($medium_image_path.$productImage->image))
        {
            unlink($medium_image_path.$productImage->image);
        }

        if(file_exists($small_image_path.$productImage->image))
        {
            unlink($small_image_path.$productImage->image);
        }

        ProductsImage::where(['id'=>$id])->delete();

        return redirect()->back()->with('flash_message_success','Image deleted successfully!');
    }

    public function edit_attributes(Request $request,$id=null)
    { 
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //dd($data);
            foreach($data['idAttr'] as $key=>$val)
            {
                ProductsAttribute::where(['id'=>$val])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back()->with('flash_message_success','Updated data successfully!');
        }
    }

    public function delete_attribute($id=null)
    {
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product attribute has been deleted sucessfully');
    }

    public function products($url=null)
    {
        //show 404 page if url not found
        $countCategory = Category::where(['url'=>$url])->count();
        $status_disable = Category::where(['url'=>$url,'status'=>0])->first();
        if($countCategory==0 || $status_disable)
        {
            abort(404);
        }
        $categories = Category::where(['parent_id'=>'0'])->get();
        $categoryDetails = Category::where(['url'=>$url])->first();
        //echo $categoryDetails->parent_id;
        if($categoryDetails->parent_id==0)
        {
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            //$cat_ids = "";
            foreach($subCategories as $subCat)
            {
                $cat_ids[] = $subCat->id.",";
            }
            $productsAll = Product::whereIn('category_id',$cat_ids)->where('status',1)->get();
        }
        else
        {
            $productsAll = Product::where(['category_id'=>$categoryDetails->id])->where('status',1)->get();
        }
        //echo "<pre>";
       // print_r($productsAll);die;
        return view('products.listing')->with(compact('categoryDetails','productsAll','categories'));
    }

    public function product($id=null)
    {
        $productCount = Product::where(['id'=>$id,'status'=>1])->count();
        if($productCount==0)
        {
            abort(404);
        }
        //getting product details
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        $productDetails = json_decode(json_encode($productDetails));
        //echo "<pre>";print_r($productDetails);;die;

        //related products
        $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();
        //$relatedProducts = json_decode(json_encode($relatedProducts));
        //echo "<pre>";print_r($relatedProducts);die;
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $productAltImages = ProductsImage::where(['product_id'=>$id])->get();

        $totalStock = ProductsAttribute::where(['product_id'=>$id])->sum('stock');

        return view('products.detail')->with(compact('productDetails','categories','productAltImages','totalStock','relatedProducts'));
    }

    public function get_product_price(Request $request)
    {
        $data = $request->all();
        //echo "<pre>";print_r($data);die;
        $proArr = explode('-',$data['idSize']);
        //print_r($proArr);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        //print_r($proAttr->price);die;
        echo $proAttr->price;
        echo "#";
        echo $proAttr->stock;
    }

    public function add_cart(Request $request)
    {
        Session::forget('CouponCode');
        Session::forget('CouponAmount');
        $data = $request->all();
        //echo "<pre>";print_r($data);die;

        if(Auth::check())
        {
            $user_email = Auth::user()->email;
        }
        else
        {
            $user_email = '';
        }
        
        if(empty($data['size']))
        {
            $size = '';
        }
        else
        {
            $sizeArr = explode('-',$data['size']);
            $size = $sizeArr[1];
        }

        $session_id = Session::get('session_id');
        if(empty($session_id))
        {
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }

        $cartCount = DB::table('cart')->where(['product_id'=>$data['product_id'],'size'=>$size,'session_id'=>$session_id])->count();

        if($cartCount>=1)
        {
            return redirect('cart')->with('flash_message_success','Product already exists into cart!');
        }
        else
        {
            $getSku = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$size])->first();
            //echo $sizeArr[1];die;
            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$getSku->sku,'product_color'=>$data['product_color'],'size'=>$size,'price'=>$data['product_price'],'quantity'=>$data['quantity'],'user_email'=>$user_email,'session_id'=>$session_id]);
            return redirect('cart')->with('flash_message_success','Product added into cart!');
        }       
        
        
    }

    public function cart(Request $request)
    {
        if(Auth::check())
        {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }
        else
        {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        
        //echo "<pre>";print_r($userCart);die;
        foreach($userCart as $key=>$product)
        {
            $productDetails = Product::where(['id'=>$product->product_id])->first();
            $userCart[$key]->image = $productDetails->image;

        }
        //echo "<pre>";print_r($userCart);die;
        return view('products.cart')->with(compact('userCart'));
    }

    public function delete_cart_product($id=null)
    {
        Session::forget('CouponCode');
        Session::forget('CouponAmount');
        DB::table('cart')->where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product has been deleted successfully!');
    }

    public function update_cart_quantity($id=null,$quantity=null)
    {
        Session::forget('CouponCode');
        Session::forget('CouponAmount');
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttrStocks = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
        //print_r($getAttrStocks);die;
        $updatedQuantity = $getCartDetails->quantity+$quantity;
        if($getAttrStocks->stock >= $updatedQuantity)
        {
            DB::table('cart')->where(['id'=>$id])->increment('quantity',$quantity);
            return redirect()->back()->with('flash_message_success','Product quantity has been updated successfully!');
        }
        else
        {
            return redirect()->back()->with('flash_message_success','Sorry, Product quantity is not available!!');
        }
        
    }

    public function apply_coupon(Request $request)
    {
        Session::forget('CouponCode');
        Session::forget('CouponAmount');
        $data = $request->all();
        //echo "<pre>";print_r($data);die;
        $countCoupon = Coupon::where(['coupon_code'=>$data['coupon_code']])->count();
        if($countCoupon==0)
        {
            return redirect()->back()->with('flash_message_success','Coupon does not exist!');
        }
        else
        {
            $couponDetails = Coupon::where(['coupon_code'=>$data['coupon_code']])->first();
            if($couponDetails->status==0)
            {
                return redirect()->back()->with('flash_message_success','This coupon is not active!');
            }
            
            if($couponDetails->expiry_date<date('Y-m-d'))
            {
                return redirect()->back()->with('flash_message_success','This coupon is expired!');
            }

            //get cart total amount
            if(Auth::check())
            {
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }
            else
            {
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
            
            $total_amount = 0;
            foreach($userCart as $item)
            {
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            //check amount type fixed or percentage
            if($couponDetails->amount_type=='Fixed')
            {
                $couponAmount = $couponDetails->amount;
            }
            else
            {
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }
            //echo $couponAmount;die;
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);
            return redirect()->back()->with('flash_message_success','Coupon has been applied successfully!');
        }
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;

        

        if($request->isMethod('post'))
        {
            $data = $request->all();
            $user_email = Auth::user()->email;
            //put email in cart table
            $session_id = Session::get('session_id');
            DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$user_email]);
            //dd($data);
            if(empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) || empty($data['shipping_pincode']) ||empty($data['shipping_mobile']))
            {
                return redirect()->back()->with('flash_message_success','Please fill all the fields!');
            }

            //check if shipping address alreaady exists or not!
            $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();

            if($shippingCount>0)
            {
                $shipping = DeliveryAddress::where('user_id',$user_id)->first();
            }
            
            if($shippingCount>0)
            {
                
                $shippingDetails = DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'pincode'=>$data['shipping_pincode'],'mobile'=>$data['shipping_mobile']]);
                //return redirect()->back()->with('flash_message_success','Shipping Address has been updated successfully!');
            }
            else
            {
                $shippingDetails = DeliveryAddress::insert(['user_id'=>$user_id,'name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'pincode'=>$data['shipping_pincode'],'mobile'=>$data['shipping_mobile']]);
            }
            return redirect()->action('ProductController@order_review');
        }
        
        $userDetails = User::find($user_id);
        $countries = Country::get();
        return view('products.checkout')->with(compact('userDetails','countries','shipping'));
    }

    public function order_review()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();

        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        //echo "<pre>";print_r($userCart);die;
        foreach($userCart as $key=>$product)
        {
            $productDetails = Product::where(['id'=>$product->product_id])->first();
            $userCart[$key]->image = $productDetails->image;

        }
        //dd($userCart);
        //dd($shippingDetails);
        //dd($userDetails);
        return view('products.order_review')->with(compact('userDetails','shippingDetails','userCart'));
    }

    public function place_order(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //dd($data);
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            //get shipping address of the user
            $shipping = DeliveryAddress::where(['user_id'=>$user_id])->first();
            //dd($shipping);

            //inserting values in orders table
            if(empty($data['coupon_code']))
            {
                $data['coupon_code'] = '';
            }

            if(empty($data['coupon_amount']))
            {
                $data['coupon_amount'] = '';
            }

            if(empty(Session::get('CouponCode')))
            {
                $couponCode = '';
            }
            else
            {
                $couponCode = Session::get('CouponCode');
            }

            if(empty(Session::get('CouponAmount')))
            {
                $couponAmount = '';
            }
            else
            {
                $couponAmount = Session::get('CouponAmount');
            }

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shipping->name;
            $order->address = $shipping->address;
            $order->city = $shipping->city;
            $order->state = $shipping->state;
            $order->country = $shipping->country;
            $order->pincode = $shipping->pincode;
            $order->mobile = $shipping->mobile;
            $order->order_status = "New";
            $order->coupon_code = $couponCode;
            $order->coupon_amount = $couponAmount;
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where('user_email',$user_email)->get();
            foreach($cartProducts as $pro)
            {
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_size = $pro->size;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_price = $pro->price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();
            }

            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);
            //COD - redirect user to thanks page
            if($data['payment_method']=='Cash On Delivery')
            {
                return redirect('/thanks');
            }
            else
            {
                return redirect('/paypal');
            }
            
        }
    }

    public function thanks(Request $request)
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->Where('user_email',$user_email)->delete();
        return view('orders.thanks');
    }

    public function user_orders(Request $request)
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        //$orders = json_decode(json_encode($orders));
        //echo "<pre>";print_r($orders);die;
        return view('orders.user_orders')->with(compact('orders'));
    }

    public function user_order_details($order_id)
    {
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
       // $orderDetails = json_decode(json_encode($orderDetails));
        //echo "<pre>";print_r($orderDetails);die;
        return view('orders.user_order_details')->with(compact('orderDetails'));
    }

    public function paypal(Request $request)
    {
        return view('orders.paypal');
    }

    public function thanks_paypal()
    {
        //$data = $request->all();
        echo $transaction_id = $_REQUEST['amt'];

        die;
        //echo "<pre>";print_r($data);die;
        return view('orders.thanks_paypal');
    }

    public function paypal_cancel(Request $request)
    {
        return view('orders.paypal_cancel');
    }


}
