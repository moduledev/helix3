<?php


namespace App\Services;


use App\Admin;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    /**
     * BaseService constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }


    /**
     * @param $attributes
     */
    public function add($attributes)
    {
        $this->model->fill($attributes->all())->save();
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function remove(int $id)
    {
        return $this->model->find($id)->delete();
    }
}
