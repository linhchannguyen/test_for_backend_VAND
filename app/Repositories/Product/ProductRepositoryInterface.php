<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function all($search = [], $orders = 'created_at', $sort = 'DESC');

    public function find($id);

    public function insertOrUpdate($input, $columnUnique);

    public function delete($id);
}
