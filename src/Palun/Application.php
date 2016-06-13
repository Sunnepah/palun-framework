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

class Application
{

    private static $applicationInstance;

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
}