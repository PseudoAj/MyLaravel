<?php

namespace App\Http\Controllers;

use App\news;

use Illuminate\Http\Request;

use App\Http\Requests;

class DataController extends Controller{
    public function index(){
      //$news=DB::table('news')->get();
      $news=news::all();
      return view('data.index')->withNews($news);
    }

    public function show(News $id){
      //$article=news::find($id);
      return view('data.show')->withArticle($id);
      //return $id;
    }
}
