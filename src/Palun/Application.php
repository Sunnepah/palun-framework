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
use Application\Controllers\PersonDetailsController;

class Application
{

    private static $applicationInstance;

    private $controller;

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
     * This will be refactored and handle properly with a router module
     */
    public function routes () {
        $path = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (!is_string ($path)) {
            throw new InvalidArgumentException('Route path must be a string');
        }

        if ($path == "/" && $requestMethod == "GET") {
            $this->response = json_encode (['Palun' => "v1.0"]);
        } elseif  ($path == '/address') {
            $this->controller = new PersonDetailsController();
            
            switch ($requestMethod) {
                case "GET" :
                    $this->response = $this->controller->get ();
                    break;
            }
        }
        else {
            header('Status: 404', TRUE, 404);
            $this->response = 'Requested endpoint '. $path . ' does not exist';
        }
    }

    /**
     *
     */
    public function dispatch () {
        echo $this->response;
    }
}