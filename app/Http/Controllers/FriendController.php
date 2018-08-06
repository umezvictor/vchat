<?php

namespace Vchat\Http\Controllers;

use Auth; //using auth facade
use Vchat\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller{

    public function getIndex(){

$friends = Auth::User()->friends();
//show friend requests
$requests = Auth::user()->friendRequests(); //friendRequests is a method in User.php
return view('friends.index')
->with ('friends', $friends)
->with('requests', $requests);
   
    }
//handles adding of friends
    public function getAdd($username)
    {
        //retrieve the user from the db where that username = the username and supply the first record
        $user = User::where('username', $username)->first();

        if(!$user){
            return redirect()
            ->route('home')
            ->with('info', 'user not found');
        }

        //avoid adding yourself as a friend
        if(Auth::user()->id === $user->id){
            return redirect()->route('home');
        }
        //checking if autenicatd user has friend request pending
        //or if the other user has a f r pending for us
        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
            return redirect()->route('profile.index', ['username' => $user->username])
            ->with('info', 'friend request pending');
        }
        //check if we are already friends
        if(Auth::user()->isFriendsWith($user)){
            return redirect()
            ->route('profile.index', ['username' => $user->username])
            ->with('info', 'You are already friends');
        }

        //add a friend
        Auth::user()->addFriend($user);
        return redirect()->route('profile.index', ['username' =>$username])
        ->with('info', 'friend request sent');
    }

    //accept friend request
    public function getAccept($username){
        $user = User::where('username', $username)->first();
        //check if user exists
        if(!$user){
            return redirect()->route('home')->with('info', 'user not found');
        }
        //check if we have received a friend friend request from that user in the first place
        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route('home');
        }
        //now accept the request if all is ok
        Auth::user()->acceptFriendRequest($user);
        return redirect()
        ->route('profile.index', ['username' => $username])
        ->with('info', 'friend request accepted');
    }
}