<?php
/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/12/16
 * Time: 1:39 AM
 */
 
require '../vendor/autoload.php';
 
 
$app = \Palun\Application::singleton();

/*
|-------------------------------------------------------------------
| Register Application Routes
|-------------------------------------------------------------------
*/
require __DIR__ . '/../application/routes.php';

/*
|-------------------------------------------------------------------
| Running the Application
|-------------------------------------------------------------------
*/
$app->run();