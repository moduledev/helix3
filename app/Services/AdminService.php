<?php


namespace App\Services;


use App\Admin;
use Illuminate\Support\Facades\Hash;

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

    public function updateAdmin($attributes, int $id)
    {
        $admin = $this->model->find($id);
        $admin->fill($attributes->validated());
        if($attributes->password) $admin->password = $attributes->password;
//        if ($attributes->activate !== 'on') $admin->activate = 'off';
        $admin->save();
        return $admin;
    }
}
