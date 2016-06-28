<?php
//Document class
class ReadOnlyDocument{
  //Allowed to be called by the instances
  public function read(){
    return "You can read";
  }

  //Not allowed to edit the Document
  private function modify(){
    return "You can modify";
  }
}

$myDoc=new ReadOnlyDocument();
var_dump($myDoc->read());
var_dump($myDoc->modify());
