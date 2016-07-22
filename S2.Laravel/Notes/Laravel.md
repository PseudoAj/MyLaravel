# Laravel from scratch

Laravel core features and development aspects visited.

## Lesson 1: Initial Setup

Following are two virtual boxes built:
1. [Using custom laravel box](../Vagrant)
1. [Laravel Hosestead project](../Homestead)

## Lesson 2: Your First View and Route

Learning from small example:
```php
Route::get('/', function () {
    return view('welcome');
});
```
The above snippet implies that when there is a get request at `/` the inline function is executed. For more complex functions we might use controller.

Creating a new view is very simple. Just add new entry into `routes.php` and create page in `resources/views`.
As an example we can create the about page by adding:
```php
// Simple example to add the new route
Route::get('about', function(){
  return view('about');
});
```
Also, we can group the pages under folder and refer them as `folder.page` or `folder/page`.

## Lesson 3: View Data and Blade
Data can be passed from the routes to views. As simple as an array can be passed on usign several ways:
```php
//Simple data passing experiments
Route::get('testData',function(){
  //Array to pass
  $me=['Ajay','Krishna','Teja'];

  //As a second argument using key value pair
  //return view('testData',['me'=>$me]);

  //Use the compact function to create array
  return view('testData',compact('me'));

  //using with method
  //return view('testData')->with('me',$me);

  //using dynamic method
  //return view('testData')->withMe($me);

```
To display the method, you could write as simple html tags like:
```php
<!-- PHP vanilla -->
<?php
	foreach ($me as $me) {
    	echo $me;
    }
?>
```
or blade actually compiles and caches using `@` notation. Example:
```php
<!-- blade engine -->
@foreach($me as $me)
	{{$me}}
@endforeach
```
More control statements can be used inline to update the views:
```php
<!-- blade engine -->
@if(empty($me))
 null.
@else
 @foreach($me as $me)
  {{$me}}
 @endforeach
@endif
```
## Lesson 4: Routing to Controllers
Real life applications are much complex than just writing inline routes. We use controllers to handle more complex requests. To create a new controller simple do:
```php
php artisan make:controller TestController
```
Simple use the template and create method to populate the view. For example to use the controller to popup view:
```php
public function test(){
	//Array to pass
    $me=['Ajay','Krishna','Teja','Kavuri'];
    
    //As a second argument using key value pair
    //return view('testData',['me'=>$me]);

    //Use the compact function to create array
    //return view('testData',compact('me'));

	//using with method
    //return view('testData')->with('me',$me);

    //using dynamic method
    return view('testData')->withMe($me);
    }
```

## Lesson 5: Layout Files
To create new view, we can wrap the html using layout files or master pages. For example, create a page called `layout.blade.php` in views where we have the basic template ready and have a section declared similar to this:
```php
@yield('mytitle')
```
Now just simply update the section using:
```php
@extends('layout')

@section('mytitle')
	Welcome
@stop

```
Using `@yeild` we could quickly update the sections and manuplate the templating.

## How to Manage Your CSS and JS
We could include css and js using the using `/css/style.css` in `public directory`. But clearly this won't scale well. Elixir


## Key concepts
1. Views in Resources
1. Requests handled by routes
1. assets will contain css files
1. blade is templating engine within laravel
1. `view::make()` is equivalent to `return view()`
1. `@` notation can trigger key words in the views


## References
1. [LAMP on ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu)
1. [install composer programatically](https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md)
1. [Solved routes 404 problem](http://laravel.io/forum/02-13-2014-receiving-404-on-all-routes-other-than-home-route)
