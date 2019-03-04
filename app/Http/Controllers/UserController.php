<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Session;
use App\Country;
use DB;

class UserController extends Controller
{
    public function userLoginRegister()
    {
    	return view('users.login_register');
    }

    public function check_email(Request $request)
    {
    	$data = $request->all();
    	$usersCount = User::where(['email'=>$data['email']])->count();
    	if($usersCount>0)
    	{
    		echo "false";
    	}
    	else
    	{
    		echo "true";
    	}

    }

    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $usersCount = User::where(['email'=>$data['email']])->count();
            if($usersCount>0)
            {
                return redirect()->back()->with('flash_message_success','Email already exists!');
            }
            else
            {
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
                {
                    Session::put('frontSession',$data['email']);
                    return redirect('/cart');
                }
            }
        }
    }

    public function user_login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>($data['password']),'admin'=>0]))
            {
                if(!empty(Session::get('session_id')))
                {
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }
                Session::put('frontSession',$data['email']);
                return redirect('/cart');
            }
            else
            {
                return redirect()->back()->with('flash_message_success','Wrong email and password!');
            }
        }
        
        //dd($data);
    }

    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        //dd($userDetails);
        $country = Country::get();

        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Account has been updated successfully!');
        }

        return view('users.account')->with(compact('country','userDetails'));
    }

    public function update_user_pwd(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->password = bcrypt($data['new_pwd']);
        $user->save();
        return redirect()->back()->with('flash_message_success','Password has been updated successfully!');
    }





    public function user_logout()
    {
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }


}
