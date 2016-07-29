<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //card has many nodes
    public function notes(){
      return $this->hasMany(Note::class);
    }

}
