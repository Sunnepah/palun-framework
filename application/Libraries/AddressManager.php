<?php

/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/25/16
 * Time: 12:37 AM
 */
 
namespace Application\Libraries;
 
use Application\Repositories\AddressRepository;

class AddressManager
{
    protected $profileRepository;

    /**
     * AddressManager constructor.
     * @param AddressRepository $addressRepository
     */
    public function __construct(AddressRepository $addressRepository) { 
        $this->addressRepository = $addressRepository;
    }

    /**
     * @return mixed
     */
    public function getAllAddresses() {
        return $this->addressRepository->all();
    }

    /**
     * @param $id
     * @return string
     */
    public function getAddress($id) {
        return $this->addressRepository->find($id);
    }

    /**
     * @param $data
     * @return string
     */
    public function createAddress($data) {
        $address = new \stdClass();
        $address->names = $data['names'];
        $address->number = $data['number'];
        $address->street = $data['street'];
        
        return $this->addressRepository->create($address);
    }

    /**
     * @param $id
     * @param $data
     * @return string
     */
    public function updateAddress($id, $data) {
        $address = new \stdClass();
        $address->names = $data['names'];
        $address->number = $data['number'];
        $address->street = $data['street'];
        
        return $this->addressRepository->update($address, $id);
    }

    /**
     * @param $id
     * @return string
     */
    public function removeAddress($id) {
        return $this->addressRepository->delete($id);
    }
}