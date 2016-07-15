<?php

class Calculator{
  //Static constant values that won't change
  const pi=3.14;
  //declare the method as a static
  public static function add(...$num){
    return array_sum($num);
  }
}

echo Calculator::add(1,2,3);
echo Calculator::pi;
