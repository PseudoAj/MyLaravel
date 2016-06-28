<?php

class Student{

  protected $name; //declare the name

  public function __construct($name){
    $this->name=$name;//assign the name
  }
}

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

$newStudent = new Student("Ajay");
$newCourse = new Course([$newStudent]);
$myUniversity = new University($newCourse);
$myUniversity->enroll(new Student("Kavuri"));
var_dump($myUniversity->getCourseStudents());
