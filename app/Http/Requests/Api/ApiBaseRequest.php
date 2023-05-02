<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiBaseRequest extends FormRequest
{
    use ApiResponseTrait, ApiResponseTrait;

    /**
     * Declare date time field to auto correct
     */
    protected $dateTimeFields = [];

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function prepareForValidation()
    {
        $data = $this->toArray();

        $this->merge($data);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $message = $validator->errors()->first();

        throw new HttpResponseException($this->responseErrorValidate($message, $errors));
    }
}
