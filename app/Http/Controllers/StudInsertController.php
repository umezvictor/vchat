<?php
namespace Vchat\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Vchat\Http\Requests;
use Vchat\Http\Controllers\Controller;
class StudInsertController extends Controller
{
public function insertform(){
return view('stud_create');
}
public function insert(Request $request){
$name = $request->input('stud_name');
DB::insert('insert into student (name) values(?)',[$name]);
echo "Record inserted successfully.<br/>";
echo '<a href="/insert">Click Here</a> to go back.';
}
}