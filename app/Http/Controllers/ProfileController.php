<?php
namespace Vchat\Http\Controllers;

use Auth;//necessary for updating records
use Vchat\Models\User;//means we are using the User model

use Illuminate\Http\Request;


class ProfileController extends Controller{
    
    public function getProfile($username){
        //fetch user record
        $user = User::where('username', $username)->first();
        if(!$user){
            abort(404);
        }
        //pull in the user's statuses

        $statuses = $user->statuses()->notReply()->get();

        //we need to return a view
        //with, means we will pass in those values or data along to the landing page
        return view('profile.index')
        ->with('user', $user)
        ->with('statuses', $statuses)
        ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
 }

    //to update user profile
    public function getEdit(){
        //render a page display the update form
        return view('profile.edit');
    }

    public function postEdit(Request $request){
        //validate input
$this->validate($request, [
    'first_name' => 'alpha|max:50',
    'last_name' => 'alpha|max:50',
    'location' => 'max:20',
]);

//fields to update
Auth::user()->update([
    'first_name' => $request->input('first_name'),
    'last_name' => $request->input('last_name'),
    'location' => $request->input('location'),
]);
//redirect user after update
return redirect()->route('profile.edit')->with('info', 'Update successful');


    }
}