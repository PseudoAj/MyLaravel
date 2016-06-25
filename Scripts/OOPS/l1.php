<?php

class Window{           //going by nouns
  public $width=10;     //attributes to noun hardcoded and public is bad
}

Class GenWindow{

  public $width;        //Attribute not hard coded

  //called when initiated
  public function __construct($width){
    $this->width=$width;
  }

}

$myWindow = new Window();
var_dump($myWindow->width);

$myGenWindow1 = new GenWindow(15);
var_dump($myGenWindow1->width);
