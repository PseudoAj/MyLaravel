<?php namespace Review;

//A generic MVC controller that accepts the http requests and reponds
class AuthController{
  //Constructor injection
  public function __construct(RegisterService $thisRService){
    $this->thisRService=$thisRService;
  }

  //Simple function to register
  public function register(){
    $this->thisRService->execute([],$this);
  }

  //Messages for outcome of the RegisterService
  public function userRegSuccess(){
    var_dump("Success Redirect");
  }

  public function userRegFailed(){
    var_dump("Failed");
  }

}
