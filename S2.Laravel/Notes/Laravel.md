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

## Lesson 6: How to Manage Your CSS and JS
We could include css and js using the using `/css/style.css` in `public directory`. But clearly this won't scale well. Elixir is laravel tool for managing the build process. `package.json` contains the required dependencies. We need to install node.js before we could use Elixir:
```bash
sudo yum install nodejs
sudo yum install npm
```
Once npm is installed, run `npm install` to install all the dependencies.
Once installed we can use elixir for build process. Also, install gulp using `npm install --global gulp`. As an illustration  change `resources\assets\sass\app.scss` and run gulp which will build the required dependencies for us. We can version a elixir property using:
```php
elixir(function(mix) {
    mix.sass('app.scss')
      .version('css/app.css');
});
```
and add:
```php
<link href="{{elixir('css/app.css')}}" rel="stylesheet" type="text/css">
```
This will create hashed versions in `public/build`. While in production this can be used as caches.

## Lesson 7: Fetching Data
We could use routes to follow the REST principles to deal with the data. Create a new controller and update the routes:
```php
Route::get('testController','DataController@');
```
Two ways to work with database:
1. Use query builder: +
The file `config/database.php` hosts a variety of files. For simplicity we can use sqlite. Create a new file using:
`touch database/database.sqlite`
Laravel uses migrations to define database queries. We can create new migration using:
```php
php artisan make:migration create_news_table --create=news
```
Open and edit your migration. Once the required fields are added just run:
```php
php artisan migrate
```
create a simple DB insert from `php artisan tinker`:
```php
DB::table('news')->insert(['title'=>'Test','desc'=>'Dummy news','created_at'=> new DateTime,'updated_at'=> new DateTime]);
```
Now, that DB is ready we can use controller to pull the data from DB and pass it to view. Example:
```php
$news=DB::table('news')->get();
return view('data.index')->withNews($news);
```
Post in the form:
```php
@foreach($news as $news)
<div>
  {{$news->title}}
</div>
<div>
  {{$news->desc}}
</div>
@endforeach
```
1. Use eloquent
Eloquent uses active record pattern. We can use:
```php
php artisan make:model news
```
This will create the model and it represents as a class for each record. Modify the controller:
```php
$news=news::all();
return view('data.index')->withNews($news);
```
Further, we can query particular record by using id, just update the route and controller with:
```php
Route::get('data/{id}','DataController@show');
```
```php
public function show($id){
  return $id;
}
```
Instead of querying with id we could just typehint it:
```php
public function show(News $id){
  //$article=news::find($id);
  return view('data.show')->withArticle($id);
  //return $id;
}
```

## Lesson 8: Defining Relationships With Eloquent
We can define relationships very naturally. 

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
