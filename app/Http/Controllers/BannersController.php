<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Image;

class BannersController extends Controller
{
    public function add_banner(Request $request)
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
    			$status = $data['status'];
    		}
    		//dd($data);
    		
    		$banner = new Banner;
    		if($request->hasFile('image'))
    		{
    			$image = $request->file('image');
    			$extension = $image->getClientOriginalExtension();
    			$img_name = rand(111,99999).".".$extension;

    			$banner_folder = 'images/frontend_images/banners/'.$img_name;

    			Image::make($image)->resize(1144,340)->save($banner_folder);

    			//save in database
    			$banner->image = $img_name;
    		}
    		
    		$banner->title = $data['banner_title'];
    		$banner->link = $data['link'];
    		$banner->status = $status;
    		$banner->save();
    	}
    	
    	return view('admin.banners.add_banner');
    }

    public function view_banner()
    {
    	$banners = Banner::get();
    	return view('admin.banners.view_banner')->with(compact('banners'));
    }

    public function edit_banner(Request $request,$id=null)
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
    			$status = $data['status'];
    		}

    		//image upload
    		if($request->hasFile('image'))
    		{
    			$image = $request->file('image');
    			$extension = $image->getClientOriginalExtension();
    			$img_name = rand(111,99999).".".$extension;

    			$banner_folder = 'images/frontend_images/banners/'.$img_name;

    			Image::make($image)->resize(1144,340)->save($banner_folder);
    		}
    		else
    		{
    			$img_name = $data['current_image'];
    		}

    		//status
    		if(empty($data['status']))
    		{
    			$status = 0;
    		}
    		else
    		{
    			$status = $data['status'];
    		}

    		if(empty($data['banner_title']))
    		{
    			$data['banner_title'] = '';
    		}

    		if(empty($data['link']))
    		{
    			$data['link'] = '';
    		}

    		//dd($data);
    		Banner::where(['id'=>$id])->update(['image'=>$img_name,'link'=>$data['link'],'title'=>$data['banner_title'],'status'=>$status]);
    		return redirect()->back()->with('flash_message_success','Banner updated successfully');
    	}
    	$banner_details = Banner::where(['id'=>$id])->first();
    	return view('admin.banners.edit_banner')->with(compact('banner_details'));
    }

    public function delete_banner($id=null)
    {
    	Banner::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Banner deleted successfully');
    }


}
