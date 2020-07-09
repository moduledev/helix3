<?php


namespace App\Contracts;


use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;

interface AdminContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getAdminById(int $id);

    /**
     * @return mixed
     */
    public function listAdmins();

    /**
     * @param AdminStoreRequest $request
     * @return mixed
     */
    public function createAdmin(AdminStoreRequest $request);

    /**
     * @param AdminUpdateRequest $request
     * @param $id
     * @return mixed
     */
    public function updateAdmin(AdminUpdateRequest $request, $id);
}
