<?php


namespace App\Services;


use App\Admin;
use GuzzleHttp\Psr7\Request;

class AdminService
{
    protected $model;

    /**
     * AdminService constructor.
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

    /** Returns all admins
     * @return Admin[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /** Returns admin by ID
     * @param Request $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /** Create new administrator
     * @param $attributes
     */
    public function add($attributes)
    {
        $this->model->fill($attributes->all())->save();
    }


    public function remove(int $id)
    {
       return $this->model->find($id)->delete();

    }
}
