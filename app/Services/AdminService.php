<?php


namespace App\Services;


use App\Admin;

class AdminService extends BaseService
{

    /**
     * AdminService constructor.
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
        $this->model = $admin;
    }
}
