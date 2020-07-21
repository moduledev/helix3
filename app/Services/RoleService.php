<?php


namespace App\Services;



use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
        $this->model = $role;
    }

    public function assignRoleToAdmin($attributes,Admin $admin)
    {
        if (Auth::user()->hasPermissionTo('role-assign')) {
            $validator = Validator::make($attributes->all(), [
                'roles' => 'array',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator);
            }

            $admin->syncRoles($attributes->roles);
            return redirect()->back()->with('success', 'Роль активована до акаунту!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }
}
