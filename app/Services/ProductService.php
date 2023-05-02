<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;

class ProductService extends BaseService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($search)
    {
        return $this->repository->all($search);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function save($input, $columnUnique)
    {
        return $this->repository->insertOrUpdate($input, $columnUnique);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
