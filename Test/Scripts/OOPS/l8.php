<?php

Interface Vehicles{
  public function numberOfWheels($brand);
}

class Car implements Vehicles{
  //implements the contract
  public function numberOfWheels($brand){
    var_dump('4: '. $brand);
  }
}

class Bike implements Vehicles{
  //implements the contract
  public function numberOfWheels($brand){
    var_dump('2: '. $brand);
  }
}


// Using the classes defined above
class Ajay{
  protected $vehicle;
  public function __construct(Vehicles $vehicle){
    $this->vehicle=$vehicle;
  }
  public function showMyVehicle(){
    $brand="Honda";
    $this->vehicle->numberOfWheels($brand);
  }
}

//Execute
$me=new Ajay(new Bike);
$me->showMyVehicle();
