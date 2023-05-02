<?php

namespace App\Repositories\Store;

use App\Models\Store;
use App\Repositories\BaseRepository;
use App\Repositories\Store\StoreRepositoryInterface;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    protected $store_model;
    public function __construct()
    {
        $this->store_model = new Store();
    }

    public function all($search = [], $orders = 'created_at', $sort = 'DESC')
    {
        $query = $this->store_model;
        if ($search) {
            $query = $query->where('store_name', 'like', '%' . $search['store_name'] . '%');
        }
        return $query->orderBy($orders, $sort);
    }

    public function find($id)
    {
        return $this->store_model->find($id);
    }

    public function insertOrUpdate($input, $columnUnique)
    {
        return $this->store_model->upsert($input, $columnUnique);
    }

    public function delete($id)
    {
        $store = $this->store_model->find($id);
        $store->delete();
    }
}
