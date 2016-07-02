<?php
/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/25/16
 * Time: 12:49 AM
 */

namespace Application\Repositories;

interface Repository
{
    /**
     * Return a collection of models
     *
     * @param  array $columns
     * @return model collections
     */
    public function all($columns = array('*'));

    /**
     * Create a new model object
     *
     * @param  \stdClass $data
     * @return mixed
     */
    public function create($data);

    /**
     * Update a model
     *
     * @param  \stdClass  $data
     * @param  $id
     * @return mixed
     */
    public function update($data, $id);

    /**
     * Delete one or more models by id
     *
     * @param  array|int $ids
     * @return mixed
     */
    public function delete($ids);

    /**
     * Find a model by id
     *
     * @param $id
     * @return mixed
     */
    public function find($id);
}