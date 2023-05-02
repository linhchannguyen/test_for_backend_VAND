<?php

namespace App\Services;

use App\Repositories\Auth\AuthRepository;

class UserService extends BaseService
{
    private $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }
}
