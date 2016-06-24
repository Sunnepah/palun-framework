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
| Registering Application Routes
|-------------------------------------------------------------------
*/
$app->get('/',  'AppController:index');
$app->get('/address',  'PersonDetailsController:get');

/*
|-------------------------------------------------------------------
| Running the Application
|-------------------------------------------------------------------
*/
$app->run();