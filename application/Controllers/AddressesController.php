<?php

/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/13/16
 * Time: 12:58 AM
 */

namespace Application\Controllers;

use Application\Libraries\AddressManager;
use Application\Repositories\AddressRepository;
use Palun\Database\Database;

class AddressesController
{
    protected $address;
    
    public function __construct()
    {   
        /*
         * This will be properly implemented using Dependency injection
         */
        $db = new Database();
        $addressRepo = new AddressRepository($db);
        $this->address = new AddressManager($addressRepo);
    }

    public function get($id) {

        $response = $this->address->getAddress($id);

        return json_encode($response);
    }

    public function getAll() {

        $allAddresses = $this->address->getAllAddresses();

        return json_encode($allAddresses);
    }

    public function post($data) {

        $response = $this->address->createAddress($data);

        return json_encode($response);
    }

    public function update($id, $data) {

        $response = $this->address->updateAddress($id, $data);

        return json_encode($response);
    }

    public function delete($id) {

        $response = $this->address->removeAddress($id);

        return json_encode($response);
    }
}