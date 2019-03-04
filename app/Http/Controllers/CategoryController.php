<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use Auth;

class CategoryController extends Controller
{
   	public function addCategory(Request $request)
   	{
   		if($request->isMethod('post'))
   		{
   			$data = $request->all();
   			//dd($data);die;
            if(empty($data['status']))
            {
               $status = 0;
            }
            else
            {
               $status = 1;
            }
   			$category = new Category;
   			$category->name = $data['category_name'];
   			$category->description = $data['description'];
            if(!empty($data['parent_id']))
            {
               $category->parent_id = $data['parent_id'];
            }
   			$category->url = $data['url'];
            $category->status = $status;
   			$category->save();
            return redirect('/admin/view_categories')->with('flash_message_success','Category added successfully');
   		}
         $levels = Category::where(['parent_id'=>'0'])->get();
   		return view('admin.categories.add_category')->with(compact('levels'));
   	}

   	public function view_categories(Request $request)
   	{
         $categories = Category::get();
   		return view('admin.categories.view_categories')->with(compact('categories'));
   	}

      public function adit_categories(Request $request,$id = null)
      {
         if($request->isMethod('post'))
         {
            $data = $request->all();
            //dd($data);

            if(empty($data['status']))
            {
               $status = 0;
            }
            else
            {
               $status = 1;
            }

            if(empty($data['parent_id']))
            {
               $parent_id = 0;
            }
            else
            {
               $parent_id = $data['parent_id'];
            }
           
            Category::where(['id'=>$id])->update(['name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url'],'parent_id'=>$parent_id,'status'=>$status]);
            return redirect('/admin/view_categories')->with('flash_message_success','Category updated successfully');
         }
         $categoriesDetails = Category::where(['id'=>$id])->first();
         $levels = Category::where(['parent_id'=>0])->get();
         return view('admin.categories.edit_categories')->with(compact('categoriesDetails','levels'));
      }

      public function delete_categories($id=null)
      {
         if(!empty($id))
         {
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Category deleted successfully');
         }
      }
}
