<?php

require 'vendor/autoload.php';

$testFake=Faker\Factory::create();

var_dump($testFake->name);
