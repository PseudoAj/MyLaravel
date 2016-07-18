<?php namespace Review;

//A simple implementation that accepts data and register the user
class RegisterService{

  //function that calls the database inserts
  public function execute(array $data, $listener){
    var_dump('Registering the user.');
    $listener->userRegSuccess();
  }
}
