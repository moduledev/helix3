<?php


namespace App\Services;


use App\Admin;

class AdminService
{
    protected $model;

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

    public function all()
    {
        $admin = $this->model->newInstance();
        return $admin->all();
    }
}
