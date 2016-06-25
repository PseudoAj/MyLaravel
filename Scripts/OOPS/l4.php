<?php
//Abstract Class
Abstract class Politician{
  //Property
  protected $name;
  //Constructor
  public function __construct($name = 'DefaultName'){ // will assign a default name if none given
    $this->name=$name;
  }
  //Method shared by all members
  public function getName(){
    return $this->name;
  }
  //Abstract method
  //We tell what child class should implement
  abstract protected function canPassbill();

}

//parent class
class President extends Politician{
  //Property
  protected $passBill = 1;
  //method
  public function helpPeople(){
    return "I am here to help";
  }

  public function canPassbill(){
    if($this->passBill==1){
      return Ture;
    }
    else {
      return False;
    }
  }
}

class VicePresident extends Politician{
  //Property
  public $name="John Doe";
  protected $passBill = 0;
  //Method overloading
  public function canPassbill(){
    if($this->passBill==1){
      return Ture;
    }
    else {
      return False;
    }
  }
}

class Senator extends Politician{
  //We don't define canPassbill which we should
}

$newVP=new VicePresident();
var_dump($newVP->canPassbill());

//Access the abstract method from child
var_dump((new VicePresident())->getName());

//Throws error
$newSen=new Senator();

//Should throw error
#new Politician();
