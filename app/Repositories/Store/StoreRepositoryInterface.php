<?php

namespace App\Repositories\Store;

use App\Repositories\BaseRepositoryInterface;

interface StoreRepositoryInterface extends BaseRepositoryInterface
{
    public function all($search = [], $orders = 'created_at', $sort = 'DESC');

    public function find($id);

    public function insertOrUpdate($input, $columnUnique);

    public function delete($id);
}
