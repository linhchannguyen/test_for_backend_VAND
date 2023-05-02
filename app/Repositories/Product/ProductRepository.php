<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $product_model;
    public function __construct()
    {
        $this->product_model = new Product();
    }

    public function all($search = [], $orders = 'created_at', $sort = 'DESC')
    {
        $query = $this->product_model;
        if ($search) {
            foreach($search as $key => $value){
                $query = $query->where($key, 'like', '%' . $value . '%');
            }
        }
        return $query->orderBy($orders, $sort);
    }

    public function find($id)
    {
        return $this->product_model->find($id);
    }

    public function insertOrUpdate($input, $columnUnique)
    {
        return $this->product_model->upsert($input, $columnUnique);
    }

    public function delete($id)
    {
        $product = $this->product_model->find($id);
        $product->delete();
    }
}
