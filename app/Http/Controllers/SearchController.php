<?php
namespace Vchat\Http\Controllers;
use DB;

use Vchat\Models\User;//means we are using the User model

use Illuminate\Http\Request;


class SearchController extends Controller{
    
    public function getResults(Request $request){
        $query = $request->input('query');
        //if no query was made in the home pag search form with a name value of 'query'
         if(!$query){
             return redirect()->route('home');
         }
         $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', 
         "%{$query}%")
         ->orWhere('username', 'LIKE', "%{$query}%")
         ->get();
         
        return view('search.results')->with('users', $users);//looping 2ru d results
    }
}