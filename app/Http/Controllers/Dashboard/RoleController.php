<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->middleware('auth:admin');
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->all();
        return view('admin.dashboard.role.index', compact('roles'));
    }

    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('role-show')) {
           $role = $this->roleService->getById($id);
           $permissions = $role->permissions;
            return view('admin.dashboard.role.show', compact('role','permissions'));
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    public function store()
    {

    }
}
