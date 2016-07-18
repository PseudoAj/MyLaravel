<?php namespace Review;

//Load the files
require_once('RegisterService.php');
require_once('AuthController.php');

//Test our little app
$thisRService=new RegisterService;
$thisAController=new AuthController($thisRService);

$thisAController->register();
