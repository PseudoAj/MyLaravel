<?php

namespace MyLaravel; //way to label and organize classes

class Course{

  protected $enrolled =[];
  //if you want to add it right away
  public function __construct($enroll=[]){//default to array
    $this->enrolled=$enroll;
  }
  //if you want to call separate method
  public function add(Student $name){
    $this->enrolled[] = $name;
  }
  //return array
  public function getRegistered(){
    return $this->enrolled;
  }
}
