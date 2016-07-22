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
Also we can group the pages under folder and refer them as `folder.page` or `folder/page`.

## Lesson 3: View Data and Blade


## Key concepts
1. Views in Resources
1. Requests handled by routes
1. assets will contain css files
1. blade is templating engine within laravel

## References
1. [LAMP on ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu)
1. [install composer programatically](https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md)
1. [Solved routes 404 problem](http://laravel.io/forum/02-13-2014-receiving-404-on-all-routes-other-than-home-route)
