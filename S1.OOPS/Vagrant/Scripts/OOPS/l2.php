<?php
class Car {
  public $model; //Properrty model
  public $name;  //Property name

  //Constructor to set the value
  public function __construct($name){
    $this->$name=$name;
  }

  //Set method to do same
  public function setModel($model){
    //We can assign additional rules here
    if($model<0){
      throw new Exception("Value can't be less than 0");
    }

    $this->model=$model;
  }

  //get method to do same
  public function getModel(){
    //We can write rules to get here
    if($this->model>2007){
      return "New model";
    }
  }
}

$myCar=new Car("Honda");
$myCar->setModel(2010);
var_dump($myCar->getModel());
