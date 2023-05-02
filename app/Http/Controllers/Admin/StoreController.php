<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Store\SaveRequest;
use App\Http\Requests\Api\Store\SearchRequest;
use App\Services\StoreService;
use App\Traits\ApiResponseTrait;
use Throwable;

class StoreController extends Controller
{
    use ApiResponseTrait;

    protected $service;
    public function __construct(StoreService $service)
    {
        $this->service = $service;
    }

    public function index(SearchRequest $request)
    {
        try {
            $input = $request->all();
            $search = [];
            if (!empty($input['store_name'])) {
                $search['store_name'] = trim($input['store_name']);
            }
            $request->route()->setParameter('page',  $input['page'] ?? 1);
            $data = $this->service->all($search)->simplePaginate(STORE_LIMIT)->toArray();

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
            $item['store_name'] = $input['store_name'];
            $item['store_address'] = $input['store_address'];
            $item['user_id'] = $input['user_id'];
            $item['id'] = $input['id'] ?? null;
            $this->service->save($item, ['id']);
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
