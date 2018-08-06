<?php
//you must set the namespace for every controller
namespace Vchat\Http\Controllers;

use Auth; //using Auth facade
use Vchat\Models\Status; //needed since i made reference to the status model 

//create a new controller class to inherit from the base controller  'controller.php'
class HomeController extends Controller{
    //next we create a method to return our home view
    public function index(){
        //if user is logged in show this page
        if(Auth::check()){
            //logic: show d status of my friends and i
            $statuses = Status::notReply()->where(function($query){
                return $query->where('user_id', Auth::user()->id)
                ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(2);//ability to paginate if  we have more than 2 records

            //dd($statuses);
            return view('timeline.index')
            ->with('statuses', $statuses);
        }
        return view('home');
    }
}