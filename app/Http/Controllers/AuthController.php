<?php
//you must set the namespace for every controller
namespace Vchat\Http\Controllers;
use Auth;
use Vchat\Models\User;
use Illuminate\Http\Request;

//create a new controller class to inherit from the base controller  'controller.php'
class AuthController extends Controller{
    //
    public function getSignup(){
        return view('auth.signup');
    }
//we  shall submit our form with the postSignup method
    public function postSignup(Request $request){
        //dd('sign up');
        // now we validate our form inputs
       $this->validate($request, [
        
        //parameters definition
        //email is required, should be unique in users table, must be a valid email, with max character of 255 
        'email' => 'required|unique:users|email|max:255',
        'username' => 'required|unique:users|alpha_dash|max:20',
        'password' => 'required|min:6',
   ]);
//to create a user, we need the User model
//check Models\User file // 
  User::create([
      'email' => $request->input('email'),
      'username' => $request->input('username'),
      'password' => bcrypt($request->input('password')),
  ]);

  return redirect() 
  ->route('home') 
  ->with('info', 'your account has been created');
}
//handle signin
public function getSignin(){
    return view('auth.signin');//
}
public function postSignin(Request $request){
    //validate input
    $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
    ]);

    if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))){
        return redirect()->back()->with('info', 'sign in failed');
    }
    return redirect()->route('home')->with('info', 'you are now signed in');
}

public function getSignout(){
    Auth::logout();
    return redirect()->route('home');
}

}