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
use Palun\Request;

class AddressesController
{
    protected $address;
    private $request;
    
    public function __construct()
    {   
        /*
         * This will be properly implemented using Dependency injection
         */
        $db = new Database();
        $addressRepo = new AddressRepository($db);
        $this->address = new AddressManager($addressRepo);
        $this->request = new Request();
    }

    public function get() {

        if (!isset($this->request->query['id']) || empty($this->request->query['id'])) {
            http_response_code(400);
            return \GuzzleHttp\json_encode([]);
        }
        
        $response = $this->address->getAddress($this->request->query['id']);
        
        if ($response == null) {
            http_response_code(404);
            return \GuzzleHttp\json_encode([]);
        }

        return json_encode($response);
    }

    public function getAll() {

        $response = $this->address->getAllAddresses();

        if ($response == null) {
            http_response_code(404);
            return \GuzzleHttp\json_encode([]);
        }
        
        return json_encode($response);
    }

    public function post() {
        
        if (empty($this->request->data)) {
            http_response_code(400);
            return \GuzzleHttp\json_encode(["message" => "Post data is empty!"]);
        }
        /** The data must be well validated before it gets here */
        $response = $this->address->createAddress($this->request->data);
        if($response == true) {
            http_response_code(201);
        }

        return json_encode($response);
    }

    public function put() {

        $id = $this->request->query['id'];
        if (!isset($id) || empty($this->request->query['id'])) {
            http_response_code(400);
            return \GuzzleHttp\json_encode(["Message" => "Missing resource id"]);
        }

        $data = $this->request->data;
        if (empty($data)) {
            http_response_code(400);
            return \GuzzleHttp\json_encode(["message" => "Data is empty!"]);
        }
        $response = $this->address->updateAddress($id, $data);

        return json_encode($response);
    }

    public function delete() {

        if (!isset($this->request->query['id']) || empty($this->request->query['id'])) {
            http_response_code(400);
            return \GuzzleHttp\json_encode([]);
        }
        
        $response = $this->address->removeAddress($this->request->query['id']);

        return json_encode($response);
    }
}