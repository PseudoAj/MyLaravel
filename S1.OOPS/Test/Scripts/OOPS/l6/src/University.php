<?php

namespace MyLaravel; //way to label and organize classes

class University{

  protected $course;

  public function __construct(Course $course){
    $this->course=$course;
  }

  public function enroll(Student $name){//type hinting in action
    $this->course->add($name);
  }

  public function getCourseStudents(){
    return $this->course->getRegistered();
  }
}
