<?php

namespace Application\Config;

class DBConfig
{
    /*
   |-----------------------------------------------------
   | Database configuration
   |-----------------------------------------------------
   | Configuration for database drivers
   */
    
    static $driver = [
        'mysql' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'address_db',
            'username'  => 'root',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]
    ];
}