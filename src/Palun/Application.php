<?php

/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/12/16
 * Time: 1:45 AM
 *
 * This class is the core of the Application registry
 */

namespace Palun;

use InvalidArgumentException;

class Application
{

    private static $applicationInstance;

    private $response;

    /**
     * Application constructor.
     */
    public function __construct () { }

    /**
     * Ensure single instance of the application is created
     * @return mixed
     */
    public static function singleton () {
        if (!isset(self::$applicationInstance)) {
            $appClass = __CLASS__;
            self::$applicationInstance = new $appClass;
        }

        return self::$applicationInstance;
    }

    /**
     * Application Routes definition
     * This will be refactored and handle properly with a router class
     */
    public function routes () {
        $path = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (!is_string ($path)) {
            throw new InvalidArgumentException('Route path must be a string');
        }

        if ($path == "/" && $requestMethod == "GET") {
            $this->response = json_encode (['Palun' => "v1.0"]);
        }
    }

    /**
     *
     */
    public function dispatch () {
        echo $this->response;
    }
}