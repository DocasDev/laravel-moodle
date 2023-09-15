# Laravel Moodle Client

### This is a fork of [zhiru/laravel-moodle](https://github.com/zhiru/laravel-moodle/tree/master)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/docasdev/laravel-moodle.svg?style=flat-square)](https://packagist.org/packages/docasdev/laravel-moodle)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/docasdev/laravel-moodle/main.svg?style=flat-square)](https://travis-ci.org/docasdev/laravel-moodle)
[![Total Downloads](https://img.shields.io/packagist/dt/docasdev/laravel-moodle.svg?style=flat-square)](https://packagist.org/packages/docasdev/laravel-moodle)

| **Laravel**  |  **laravel-modules** |
|---|---|
| ^10.10  | ^1.0  |

`docasdev/laravel-moodle` is a Laravel package which created way to interact with moodle through api/webservice.

## In adaptation and Work in Progress

## Installation
To install through Composer, by run the following command:
```
$ composer require docasdev/laravel-moodle
```
The package will automatically register a service provider and alias.

Optionally, publish the package's configuration file by running:

``` bash
php artisan vendor:publish --provider="DocasDev\LaravelMoodle\LaravelMoodleServiceProvider"
```

## Usage

Create instance of moodle clients, e.g. REST client:
```php
$client = new RestClient();
```

If there is no build in needed services and entities, you can create it.  
Services must extend Service abstract class, entities (as DTO's) must extend Entity abstract class.  

Also, you can use moodle client without service layer:
```php
$courses = $client->sendRequest('core_course_get_courses', $parameters);
```
