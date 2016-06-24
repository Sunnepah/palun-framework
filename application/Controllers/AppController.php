<?php
/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/24/16
 * Time: 7:22 PM
 */

namespace Application\Controllers;


class AppController
{
    public function index() {
        return json_encode(['Palun' => "v1.0"]);;
    }
}