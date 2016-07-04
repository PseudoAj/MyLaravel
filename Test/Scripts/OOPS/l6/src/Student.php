<?php

namespace MyLaravel; //way to label and organize classes

class Student{

  protected $name; //declare the name

  public function __construct($name){
    $this->name=$name;//assign the name
  }
}
