<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Card;

class CardsController extends Controller
{
  public function index(){
    $cards = Card::all();
    return view('cards.index')->withCards($cards);
  }

  public function show(Card $id){
    //$card=Card::find($id);
    return view('cards.show')->withCard($id);
  }
}
