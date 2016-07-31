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
use Lustre\Database\Database;
use Lustre\Request;
use Lustre\Response;

class AddressesController
{
    protected $address;
    private $request;

    /**
     * AddressesController constructor.
     */
    public function __construct() {   
        /*
         * This will be properly implemented using Dependency injection
         */
        $db = new Database();
        $addressRepo = new AddressRepository($db);
        $this->address = new AddressManager($addressRepo);
        $this->request = new Request();
    }
    
    /**
     * Retrieve an address
     * 
     * @return \Lustre\Response
     */
    public function get() {

        if (!isset($this->request->query['id']) || empty($this->request->query['id'])) {
            return (new Response(null, 400))->json();
        }
        
        $response = $this->address->getAddress($this->request->query['id']);
        
        if ($response == null) {
            return (new Response(null, 404))->json();
        }

        return (new Response($response, 200))->json();
    }

    /**
     * Retrieve all addresses.
     * 
     * @return \Lustre\Response
     */
    public function getAll() {

        $response = $this->address->getAllAddresses();

        if ($response == null) {
            return (new Response(null, 400))->json();
        }

        return (new Response($response, 200))->json();
    }

    /**
     * Create a new address
     * 
     * @return \Lustre\Response
     */
    public function post() {
        
        if (empty($this->request->data)) {
            return (new Response(["message" => "Post data is empty!"], 400))->json();
        }
        
        /** The data must be well validated before it gets here */
        $response = $this->address->createAddress($this->request->data);
        if($response == true) {
            return (new Response($response, 201))->json();
        }

        return (new Response($response, 500))->json();
    }

    /**
     * Update an address
     * 
     * @return \Lustre\Response
     */
    public function put() {
        
        if (!isset($this->request->query['id']) || empty($this->request->query['id'])) {
            return (new Response(["Message" => "Missing resource id"], 400))->json();
        }

        $data = $this->request->data;
        if (empty($data)) { 
            return (new Response(["message" => "Data is empty!"], 400))->json();
        }
        
        $response = $this->address->updateAddress($this->request->query['id'], $data);

        return (new Response($response, 200))->json();
    }

    /**
     * Remove an address
     * 
     * @return \Lustre\Response
     */
    public function delete() {

        if (!isset($this->request->query['id']) || empty($this->request->query['id'])) {
            
            return (new Response(null, 400))->json();
        }
        
        $response = $this->address->removeAddress($this->request->query['id']);

        return (new Response($response, 200))->json();
    }
}