<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;

class userController extends Controller
{
     public function getSignup()
     {
         return view('users.signup');
     }

     public function postSignup(Request $request)
     {
            $this->validate($request,[
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4'
            ]);

            $user = new User([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]);

            $user->save();
            Auth::login($user);
            if(Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('user.profile');
     }

     public function getSignin()
     {
         return view('users.signin');
     }

     public function postSignin(Request $request)
     {

            $this->validate($request,[
                'email' => 'required|email',
                'password' => 'required|min:4'
            ]);

            if(Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])){
                if(Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
                return redirect()->route('user.profile');
            }
            return redirect()->back();
     }

     public function getProfile()
     {
        $orders = Auth::user()->orders;
        $orders->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
         return view('users.profile',['orders' => $orders]);
     }

     public function logout(Request $request)
     {
         Auth::logout();
         return redirect()->route('user.signin');
     }

}
