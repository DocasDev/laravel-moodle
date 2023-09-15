# Laravel Moodle Client

### This is a fork of [DocasDev/laravel-moodle](https://github.com/DocasDev/laravel-moodle/tree/master)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/DocasDev/laravel-moodle.svg?style=flat-square)](https://packagist.org/packages/DocasDev/laravel-moodle)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/DocasDev/laravel-moodle/master.svg?style=flat-square)](https://travis-ci.org/DocasDev/laravel-moodle)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/DocasDev/laravel-moodle.svg?maxAge=86400&style=flat-square)](https://scrutinizer-ci.com/g/DocasDev/laravel-moodle/?branch=main)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/25320a08-8af4-475e-a23e-3321f55bf8d2.svg?style=flat-square)](https://insight.sensiolabs.com/projects/25320a08-8af4-475e-a23e-3321f55bf8d2)
[![Quality Score](https://img.shields.io/scrutinizer/g/DocasDev/laravel-moodle.svg?style=flat-square)](https://scrutinizer-ci.com/g/DocasDev/laravel-moodle)
[![Total Downloads](https://img.shields.io/packagist/dt/DocasDev/laravel-moodle.svg?style=flat-square)](https://packagist.org/packages/DocasDev/laravel-moodle)

| **Laravel**  |  **laravel-modules** |
|---|---|
| ^10.10  | ^1.0  |

`DocasDev/laravel-moodle` is a Laravel package which created way to interact with moodle through api/webservice.

## In adaptation and Work in Progress

## Install
To install through Composer, by run the following command:
```
$ composer require DocasDev/laravel-moodle
```
The package will automatically register a service provider and alias.

Optionally, publish the package's configuration file by running:

``` bash
php artisan vendor:publish --provider="DocasDev\LaravelMoodle\LaravelMoodleServiceProvider"
```

### Incorrect Documentation below 

## Installation
The recommended way to install the library is through Composer:


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
