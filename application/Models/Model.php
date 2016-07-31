<?php
/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/25/16
 * Time: 11:51 AM
 */

namespace Application\Models;

use Lustre\Database\DatabaseInterface;

abstract class Model
{
    /**
     * @param DatabaseInterface $db
     * @return array
     */
    public function findAll(DatabaseInterface $db) {
        return $db->getAll($this->table);
    }

    /**
     * @param DatabaseInterface $db
     * @return array
     */
    public function findOne(DatabaseInterface $db, $id) {
        return $db->find($this->table, $id);
    }

    /**
     * @param DatabaseInterface $db
     * @param $data
     * @return string
     */
    public function save(DatabaseInterface $db, $data) {
        return $db->insert($this->table, $data);
    }

    /**
     * @param DatabaseInterface $db
     * @param $data
     * @param $id
     * @return bool|\mysqli_result
     */
    public function update(DatabaseInterface $db, $data, $id) {
        return $db->update($this->table, $data, $id);
    }

    /**
     * @param DatabaseInterface $db
     * @param $id
     * @return bool
     */
    public function delete(DatabaseInterface $db, $id) {
        return $db->delete($this->table, $id);
    }
}