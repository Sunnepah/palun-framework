<?php
/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/25/16
 * Time: 1:23 AM
 */

namespace Application\Repositories;

use Application\Models\Address;
use Lustre\Database\Database;

class AddressRepository implements Repository
{

    protected $model;
    
    private $db;

    /**
     * Repository constructor.
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->model = new Address();
        $this->db = $db;
    }

    /**
     * @param array $columns
     * @return array
     */
    public function all($columns = array('*')) {
    
        return $this->model->findAll($this->db);
    }

    /**
     * @param \stdClass $data
     * @return string
     */
    public function create($data) {
        return $this->model->save($this->db, $data);
    }

    /**
     * @param \stdClass $data
     * @param $id
     * @return string
     */
    public function update($data, $id) {
        return $this->model->update($this->db, $data, $id);
    }

    /**
     * @param array|int $id
     * @return string
     */
    public function delete($id) {
        return $this->model->delete($this->db, $id);
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public function find($id) {
        return $this->model->findOne($this->db, $id);
    }
}