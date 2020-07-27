<?php


namespace App\Services;


use App\User;

class UserService extends BaseService
{
    protected $model;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }

}
