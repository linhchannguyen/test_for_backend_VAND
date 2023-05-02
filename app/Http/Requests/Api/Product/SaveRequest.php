<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\ApiBaseRequest;

class SaveRequest extends ApiBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => "required|max:255",
            'product_short_name' => "required|max:255",
            'sku' => "required|max:25|unique:products,sku,".$this->id,
            'price' => "nullable|numeric|min:0|max:99999999",
            'quantity' => "nullable|numeric|min:0|max:99999999",
            'product_del_flg' => "boolean",
            'store_id' => "required|exists:stores,id",
        ];
    }
}
