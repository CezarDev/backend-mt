<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected  $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->repository->find($id);
        if ($model) {
            return $model->update($data);
        }
        return null;
    }

    public function delete($id)
    {
        $model = $this->repository->find($id);
        if ($model) {
            return $model->delete();
        }
        return null;
    }

    public function paginate($perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    public function findBy($field, $value)
    {
        return $this->repository->where($field, $value)->get();
    }

    public function findById($id)
    {
        return $this->repository->find($id);
    }

    public function findByField($field, $value)
    {
        return $this->repository->where($field, $value)->get();
    }

    public function findByFields(array $fields)
    {
        $query = $this->repository;
        foreach ($fields as $field => $value) {
            $query = $query->where($field, $value);
        }
        return $query->get();
    }

    public function findByFieldOrFail($field, $value)
    {
        return $this->repository->where($field, $value)->firstOrFail();
    }
}
