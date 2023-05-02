<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\SaveRequest;
use App\Http\Requests\Api\Product\SearchRequest;
use App\Services\ProductService;
use App\Traits\ApiResponseTrait;
use Throwable;

class ProductController extends Controller
{
    use ApiResponseTrait;

    protected $service;
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(SearchRequest $request)
    {
        try {
            $input = $request->all();
            $search = [];
            if (!empty($input['product_short_name'])) {
                $search['product_short_name'] = trim($input['product_short_name']);
            }
            if (!empty($input['sku'])) {
                $search['sku'] = trim($input['sku']);
            }
            $request->route()->setParameter('page',  $input['page'] ?? 1);
            $data = $this->service->all($search)->simplePaginate(PRODUCT_LIMIT)->toArray();

            return $this->responseSuccess('Success', $data);
        } catch (Throwable $e) {
            return $this->responseSystemError(__('system.server_error'));
        }
    }

    public function show($id)
    {
        try {
            $data = $this->service->find($id);

            return $this->responseSuccess('Success', $data);
        } catch (Throwable $e) {
            return $this->responseSystemError(__('system.server_error'));
        }
    }

    public function save(SaveRequest $request)
    {
        try {
            $input = $request->all();
            $id = $input['id'] ?? null;
            if($id){
                $data = $this->service->find($id);
                if(!$data){
                    return $this->responseNotFound('Item does not exist.');
                }
            }
            $item['product_name'] = $input['product_name'];
            $item['product_short_name'] = $input['product_short_name'];
            $item['sku'] = $input['sku'];
            $item['price'] = $input['price'] ?? 0;
            $item['quantity'] = $input['quantity'] ?? 0;
            $item['product_description'] = $input['product_description'] ?? null;
            $item['product_del_flg'] = $input['product_del_flg'];
            $item['store_id'] = $input['store_id'];
            $item['id'] = $input['id'] ?? null;
            $this->service->save($item, ['id', 'sku']);
            return $this->responseCreated('Success');
        } catch (Throwable $e) {
            return $this->responseSystemError(__('system.server_error'));
        }
    }

    public function delete($id)
    {
        try {
            $data = $this->service->find($id);
            if(!$data){
                return $this->responseNotFound('Item does not exist.');
            }
            $this->service->delete($id);

            return $this->responseNoContent('Success');
        } catch (Throwable $e) {
            return $this->responseSystemError(__('system.server_error'));
        }
    }
}
