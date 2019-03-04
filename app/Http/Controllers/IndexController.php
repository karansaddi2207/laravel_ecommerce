<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class IndexController extends Controller
{
    public function index()
    {
    	//$productsAll = Product::orderBy('id','DESC')->get();
    	//for getting product in random order
    	$productsAll = Product::inRandomOrder()->where('status',1)->get();

    	$categories = Category::with('categories')->where(['parent_id'=>'0'])->get();
    	$categories = json_decode(json_encode($categories));
    	//$categories = Category::where(['parent_id'=>'0'])->get();
    	//echo "<pre>";print_r($categories);die;
    	//$cat_menu = '';
    	//foreach($categories as $cat)
    	/*{
    		$cat_menu .= "<div class='panel panel-default'>
								<div class='panel-heading'>
									<h4 class='panel-title'>
										<a data-toggle='collapse' data-parent='#".$cat->id."' href='#".$cat->url."'>
											<span class='badge pull-right'><i class='fa fa-plus'></i></span>
											".$cat->name."
										</a>
									</h4>
								</div>
								<div id='".$cat->url."' class='panel-collapse collapse'>
										<div class='panel-body'>
											<ul>";
					$sub_category = Category::where(['parent_id'=>$cat->id])->get();
					foreach($sub_category as $sub_cat)
					{	
							$cat_menu .= "<li><a href='#'>".$sub_cat->name."</a></li>";
					}
					$cat_menu .= "</ul>
										</div>
							 	</div>
						    </div>";		
    	//}*/
		$banners = Banner::where(['status'=>'1'])->get();

    	return view('index')->with(compact('productsAll','categories','banners'));
    }
}
