<?php

//route for home page
Route::get('/', [
    'uses' => '\Vchat\Http\Controllers\HomeController@index',
    'as' => 'home', 
]);
//the guest middleware manages redirection durinng
//guest comes from kernel.phpm 
Route::get('/signup', [
    'uses' => '\Vchat\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup', 
    'middleware' => ['guest'],
]);

Route::post('/signup', [
    'uses' => '\Vchat\Http\Controllers\AuthController@postSignup',
    'middleware' => ['guest'],
    
]);

Route::get('/signin', [
    'uses' => '\Vchat\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',  
    'middleware' => ['guest'],
]);

Route::post('/signin', [
    'uses' => '\Vchat\Http\Controllers\AuthController@postSignin',
    'middleware' => ['guest'],
    //'as' => 'auth.signup', not needed
]);


Route::get('/signout', [
    'uses' => '\Vchat\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout', 
]);

Route::get('alert', function () {
    return redirect()->route('home')->with('info', 'you have signed up');
});

//search

Route::get('/search', [
    'uses' => '\Vchat\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
]);

//user profile
Route::get('/user/{username}', [
    'uses' => '\Vchat\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
]);

//update profile only if signed in, using the auth middleware
Route::get('/profile/edit', [
    'uses' => '\Vchat\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth'],
]);

Route::post('/profile/edit', [
    'uses' => '\Vchat\Http\Controllers\ProfileController@postEdit',
     'middleware' => ['auth'],
]);


//route for friend requests
Route::get('/friends', [
    'uses' => '\Vchat\Http\Controllers\FriendController@getIndex',
    'as' => 'friends.index',
    'middleware' => ['auth'],
]);

Route::get('/friends/add/{username}', [
    'uses' => '\Vchat\Http\Controllers\FriendController@getAdd',
    'as' => 'friend.add',
    'middleware' => ['auth'],
]);

Route::get('/friends/accept/{username}', [
    'uses' => '\Vchat\Http\Controllers\FriendController@getAccept',
    'as' => 'friend.accept',
    'middleware' => ['auth'],
]);

//route for statuses
/*understanding routing
the browser will show localhost:8000/status
but in our href links, we will use status.post to refer to it
*/
Route::post('/status', [
    'uses' => '\Vchat\Http\Controllers\StatusController@postStatus',
    'as' => 'status.post',
    'middleware' => ['auth'],
]);

//route for like statuses

Route::post('/status/{statusId}/reply', [
    'uses' => '\Vchat\Http\Controllers\StatusController@getLike',
    'as' => 'status.reply',
    'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/like', [
     'uses' => '\Vchat\Http\Controllers\StatusController@getLike',
    'as' => 'status.like',//route
    'middleware' => ['auth'],
]);










//Route::get('insert','StudInsertController@insertform');
//Route::post('create','StudInsertController@insert');

//route for auttentication page
// Route::get('/signup','AuthController@getSignup')->name('auth.signup');

// Route::post('/signup','AuthController@postSignup');
