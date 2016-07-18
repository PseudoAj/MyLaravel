# php OOPS Concepts

Object oriented programming concepts are fundamental knowledge needed to work with Laravel.

## Lesson 1: Classes
1. Procedural way of writing is nightmare to maintain and work with.
1. Procedurally written code can't be reused

Lets start with basics. A class can be called and attributes can be accessed using the noun analogy(all nouns are classes and actions are methods). Example:
```php
<?php

class Window{           //going by nouns
  public $width=10;     //attributes to noun hardcoded and public is bad
}

$myWindow = new Window();
var_dump($myWindow->width);
```

Output:
`int(10)`

Now, let's try to write more generic class that has the attributes called using a `__construct` method. Example:
```php
<?php

class Window{           //going by nouns
  public $width=10;     //attributes to noun hardcoded and public is bad
}

Class GenWindow{

  public $width;        //Attribute not hard coded

  //called when initiated
  public function __construct($width){
    $this->width=$width;
  }

}

$myWindow = new Window();
var_dump($myWindow->width);

$myGenWindow1 = new GenWindow(15);
var_dump($myGenWindow1->width);

```
Output:
`int(15)`

## Lesson 2: Getters and Setters
Getters and setters allow protection and security; although we can get hands on properties directly. Allows a way to impose additional rules. Example:
```php
<?php
class Car {
  public $model; //Properrty model
  public $name;  //Property name

  //Constructor to set the value
  public function __construct($name){
    $this->$name=$name;
  }

  //Set method to do same
  public function setModel($model){
    //We can assign additional rules here
    if($model<0){
      throw new Exception("Value can't be less than 0");
    }

    $this->model=$model;
  }

  //get method to do same
  public function getModel(){
    //We can write rules to get here
    if($this->model>2007){
      return "New model";
    }
  }
}

$myCar=new Car("Honda");
$myCar->setModel(2010);
var_dump($myCar->getModel());
```
Output: `string(9) "New model"`

## Lesson 3: Encapsulation
All the examples have the variables declared as public which allows any property/method to be altered. Encapsulation is a way to hide as much properties and actions as possible. Example:
```php
<?php
//Document class
class ReadOnlyDocument{
  //Allowed to be called by the instances
  public function read(){
    return "You can read";
  }

  //Not allowed to edit the Document
  private function modify(){
    return "You can modify";
  }
}

$myDoc=new ReadOnlyDocument();
var_dump($myDoc->read());
var_dump($myDoc->modify());
```
Output:
```bash
string(12) "You can read"

PHP Fatal error:  Call to private method ReadOnlyDocument::modify()
```
## Lesson 4: Inheritance
Access the parent properties and methods by inheriting(extending). This will allow the classes to have a hierarchy. Example:
```php
<?php
//parent class
class President{
  //method
  public function helpPeople(){
    return "I am here to help";
  }
}

class VicePresident extends President{
  //Property
  public $name="John Doe";
}

$newVP=new VicePresident();
var_dump($newVP->helpPeople());
```
Output: `string(17) "I am here to help"`

The same inheritance can be included with the method overloading. The same method definition on the child method takes precedence over the parent method. Example:
```php
<?php
//parent class
class President{
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

class VicePresident extends President{
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

$newVP=new VicePresident();
var_dump($newVP->canPassbill());

```
Output: `bool(false)`

Interfaces and abstract classes are the two extensions of the inheritance. An abstract class will define the contract/template what a child class needs to implement inorder to be a valid way of implementation. We try to define a abstract method  but not implement in child class. Example:
```php
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
```
Output: ```Bash
PHP Fatal error:  Class Senator contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (Politician::canPassbill) in ```


## Lesson 5: Messages 101
Classes can be nicely structured using the type hinting(allow custom types be declared) and messages(notifying different classes about the action). In the following example consider the `Student` class is type hinted in `University class`. Also, `depends` is a key concept to link classes. Here University depends on students. Here is the example:
```php
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

```
Output:
```php
array(2) {
  [0]=>
  object(Student)#1 (1) {
    ["name":protected]=>
    string(4) "Ajay"
  }
  [1]=>
  object(Student)#4 (1) {
    ["name":protected]=>
    string(6) "Kavuri"
  }
}

```

## Lesson 6: Namespacing and autoloading

A proper way to write the classes is to have one script per class. Let's take the above example and write it in three scripts. To load the dependencies we can use composer. Use `composer require <package name>` which will generate `vendor/autoload.php`. By simply creating a `composer.json` file we can load all the classes. One point to note here is that namespaces are needed to load the classes properly. So here is the example:

1. We include `composer.json`
```php
{
  "autoload": {
    "psr-4": {
        "MyLaravel\\": "src"
    }
  }
}
```

1. Save the directory structure similar to name space and update `Student.php`, `Course.php` and `University.php`

```php
<?php

namespace MyLaravel; //way to label and organize classes

class Student{

  protected $name; //declare the name

  public function __construct($name){
    $this->name=$name;//assign the name
  }
}
```

```php
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

```

```php
<?php

namespace MyLaravel; //way to label and organize classes

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

```

Lastly, Update the main class with namespaces `l6.php`

```php
<?php

require 'vendor/autoload.php';

$newStudent = new MyLaravel\Student("Ajay");
$newCourse = new MyLaravel\Course([$newStudent]);
$myUniversity = new MyLaravel\University($newCourse);
$myUniversity->enroll(new MyLaravel\Student("Kavuri"));
var_dump($myUniversity->getCourseStudents());

```

Output:
```php
array(2) {
  [0]=>
  object(MyLaravel\Student)#3 (1) {
    ["name":protected]=>
    string(4) "Ajay"
  }
  [1]=>
  object(MyLaravel\Student)#5 (1) {
    ["name":protected]=>
    string(6) "Kavuri"
  }
}
```

## Lesson 7: Statics and Constants
Having a static method will allow us to bypass instance and directly call the method. Static is anti-pattern in most of the cases. We use scope resolution operator `::` to access static properties and methods. Statics break encapsulation and are shared among the instances. Example:
```php
<?php

class Calculator{
  //declare the method as a static
  public static function add(...$num){
    return array_sum($num);
  }
}

echo Calculator::add(1,2,3);
```

Output: `6`

Sometimes the objects might have the values that are not expected to change. Constants are used to access them. Also, laravel source has some global functions declared as static. Example:
```php
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

```
Output: `63.14`

## Lesson 8: Interfaces
Interfaces aren't for the real logic. It is a contract for the classes implementing it.Interfaces allow us to swap the specific classes by grouping them under an interface. The strategy is:
> Program to an interface not implementation

Example:
```php
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
```
Output: `string(8) "2: Honda"`

We can simple swap between Bike and Car in the execution but not the actual class implementations. This way we can extend the classes without any issues.

## Lesson 9: Interfaces vs Abstract Classes
Interfaces define a generic contract and laravel ships with a bunch of interfaces for us to work with. Interface is public API and has no logic what so ever. Abstract class will have some implementation defining contract. They both can work together too, depends on the programming logic.

## Lesson 10: Review
Scope and context of the project is important to use the OOPS concepts. Some concepts using simple registration:
1. Method injection: Reference a required class (`RegisterService`) inside method when you only need it once in the parent class (`AuthController`).
1. Constructor injection: Reference a required class (`RegisterService`) inside constructor of your class when you might class more than once in your parent class (`AuthController`).
1. Messages: Notify parent class (`AuthController`) with the outcome using messages.
1. Iterface guarantees the methods exists in the parent class
Example:
 `RegisterService`
 ```php
 <?php namespace Review;

 //A simple implementation that accepts data and register the user
 class RegisterService{

   //function that calls the database inserts
   public function execute(array $data, $listener){
     var_dump('Registering the user.');
     $listener->userRegSuccess();
   }
 }
 ```
 `AuthController`
 ```php
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
 ```

`l10`

```php
<?php namespace Review;

//Load the files
require_once('RegisterService.php');
require_once('AuthController.php');

//Test our little app
$thisRService=new RegisterService;
$thisAController=new AuthController($thisRService);

$thisAController->register();

```

Output:

```php
vagrant@LaravelTest:/var/www/Scripts/OOPS/l10/src$ php l10.php
string(21) "Registering the user."
string(16) "Success Redirect"
```
## Key Points
1. Non Abstract classes are concrete classes
1. Interface VS Abstract Class: Abstract classes are classes with methods and implementation. They contain abstract methods which impose the methods that needs to be implemented by child class that extends them. Interfaces are templates for the classes that implement them.
