<?php

/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/13/16
 * Time: 12:58 AM
 */

namespace Application\Controllers;

class PersonDetailsController
{

    public function get () {
        
        $address = $this->readCsvFile ();

        return json_encode ($address);
    }

    public function readCsvFile () {
        $file = fopen (__DIR__ . '/../../example.csv', 'r');

        $addresses = [];
        
        while (($line = fgetcsv ($file)) !== FALSE) {
            $addresses[] = ['name' => $line[0], 'phone' => $line[1], 'street' => $line[2]];
        }

        fclose ($file);
        
        return $addresses;
    }
}