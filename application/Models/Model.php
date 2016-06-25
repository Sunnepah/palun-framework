<?php
/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/25/16
 * Time: 11:51 AM
 */

namespace Application\Models;

use Palun\Database\Database;

abstract class Model
{
    /**
     * @param Database $db
     * @return array
     */
    public function findAll(Database $db) {
        return $db->getAll($this->table);
    }

    /**
     * @param Database $db
     * @param $data
     * @return string
     */
    public function save(Database $db, $data) {
        return $db->insert($this->table, $data);
    }

    /**
     * @param Database $db
     * @param $data
     * @param $id
     * @return bool|\mysqli_result
     */
    public function update(Database $db, $data, $id) {
        return $db->update($this->table, $data, $id);
    }

    /**
     * @param Database $db
     * @param $id
     * @return bool
     */
    public function delete(Database $db, $id) {
        return $db->delete($this->table, $id);
    }
}