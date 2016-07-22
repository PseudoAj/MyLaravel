<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function test(){
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
    }

    public function about(){
      return view('static.about');
    }
}
