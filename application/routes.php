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

$app->get('/addresses',  'AddressesController:getAll');
$app->get('/address',  'AddressesController:get');
$app->post('/address',  'AddressesController:post');
$app->put('/address',  'AddressesController:put');
$app->delete('/address',  'AddressesController:delete');