<?php
/**
 * User: sunnepah
 * Date: 6/22/16
 * Time: 3:00 PM
 */

/*
|-------------------------------------------------------------------
| Registering all Application routes
|-------------------------------------------------------------------
*/

$app->get('/',  'AppController:index');

$app->get('/address',  'PersonDetailsController:get');