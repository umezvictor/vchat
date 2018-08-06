<?php

namespace Vchat\Http\Controllers;
use Auth;

use Vchat\Models\User;//means we are using the User model
use Vchat\Models\Status;

use Illuminate\Http\Request;



class StatusController extends Controller{
    public function postStatus(Request $request)
    {
        //I used Request because i will be dealing with form input and validation

        $this->validate($request, [
            'status' => 'required|max:1000',
        ]);
        
        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);
        return redirect()->route('home')->with('info', 'status posted');

    }

    //post replies.  reply-{$statusId} is referenced fron timeline.index.php
    public function postReply(Request $request, $statusId){
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000',
        ], [
                //custom error messagee for 'required'
                'required' => 'The reply body is required'
        ]);


        //now lets submit the reply;
        //things to capture. 1 relate it to the reply, user and checkingif we are friends

        $status = Status::notReply()->find($statusId);

        //check if the status exists
        if(!$status){
            return redirect()->route('home');
        }
        //next, check if the currently authenticated user is frinds with the owner of the status above
        if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id 
        !== $status->user->id){
            return redirect()->route('home');
        }

        //the actual insert
        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());

        $status->replies()->save($reply);
        return redirect()->back();
    }

    public function getLike($statusId){
        $status = Status::find($statusId);

        if(!$status){
            return redirect()->route('home');
        }

        if(!Auth::user()->isFriendsWith($status->user)){
            return redirect()->route('home');
        }

        //checkif user has already liked status
        if(Auth::user()->hasLikedStatus($status)){
            return redirect()->back();
        }
        //creating the like
        $like = $status->likes()->create([]); //accessing the likes relationship in status table 
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }
}