<?php

namespace App\Repositories;

class MainRepository
{
    protected $model;

    /**
     * Find all items from the model
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find a specific item from the model according with the id passed
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new item according the payload sent
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload)
    {
        return $this->model->create($payload);
    }

    /**
     * Updates a model according the payload sent and the id
     * @param array $payload
     * @param int $id
     * @return mixed
     */
    public function update(array $payload, int $id)
    {
        $item = $this->find($id);

        if(!$item) return null;

        return $item->update($payload);
    }

}
