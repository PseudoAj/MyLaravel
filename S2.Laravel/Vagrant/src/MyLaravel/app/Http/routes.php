<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Simple example to add the new route
Route::get('about', 'TestController@about');

//Simple data passing experiments
Route::get('testData',function(){
  //Array to pass
  $me=['Ajay','Krishna','Teja','Kavuri'];

  //As a second argument using key value pair
  //return view('testData',['me'=>$me]);

  //Use the compact function to create array
  //return view('testData',compact('me'));

  //using with method
  //return view('testData')->with('me',$me);

  //using dynamic method
  return view('testData')->withMe($me);
});

//Simple controller example
Route::get('testController','TestController@test');

Route::get('data','DataController@index');
Route::get('data/{id}','DataController@show');
