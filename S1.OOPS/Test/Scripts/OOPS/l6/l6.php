<?php

require 'vendor/autoload.php';

$newStudent = new MyLaravel\Student("Ajay");
$newCourse = new MyLaravel\Course([$newStudent]);
$myUniversity = new MyLaravel\University($newCourse);
$myUniversity->enroll(new MyLaravel\Student("Kavuri"));
var_dump($myUniversity->getCourseStudents());
