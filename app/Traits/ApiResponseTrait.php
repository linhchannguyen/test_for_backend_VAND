<?php
namespace App\Traits;

trait ApiResponseTrait {

    // Successfully statuses
    static $status_success = 200;
    static $status_created = 201;
    static $status_accepted = 202;
    static $status_no_content = 204;

    // Error statuses
    static $status_validate_error = 400;
    static $status_forbidden = 403;
    static $status_not_found = 404;
    static $status_system_error = 500;
    static $status_unauthorized = 401;

    static $content_type = 'application/json;charset=UTF-8';

    private function response(string $code, string $message, $data = [])
    {
        if($code == self::$status_validate_error){
            $quantity_error = count($data);
            if($quantity_error > 1){
                if($message != 'unpermission_list'){
                    $message = config('messages.MSFA0144');
                }
            }
        }
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'data' => $data
            ],
            $code,
            ['Content-Type' => self::$content_type],
            JSON_UNESCAPED_UNICODE
        );
    }

    private function responseUnauthorizedResult(string $code, string $message, $data = [])
    {
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'data' => $data
            ],
            $code,
            ['Content-Type' => self::$content_type],
            JSON_UNESCAPED_UNICODE
        );
    }

    // Error methods
    public function responseErrorValidate(string $message, $data = [])
    {
        return $this->response(self::$status_validate_error, $message, $data);
    }

    public function responseUnauthorized(string $message, $data = [])
    {
        return $this->responseUnauthorizedResult(self::$status_unauthorized, $message, $data);
    }

    public function responseSuccess(string $message, $data = [])
    {
        return $this->response(self::$status_success, $message, $data);
    }

    public function responseSystemError(string $message, $data = [])
    {
        return $this->response(self::$status_system_error, $message, $data);
    }

    public function responseCreated(string $message, $data = [])
    {
        return $this->response(self::$status_created, $message, $data);
    }

    public function responseNoContent(string $message, $data = [])
    {
        return $this->response(self::$status_no_content, $message, $data);
    }

    public function responseNotFound(string $message, $data = [])
    {
        return $this->response(self::$status_not_found, $message, $data);
    }
}