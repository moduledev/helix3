<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    protected $roleService;

    /**
     * RoleController constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->middleware('auth:admin');
        $this->roleService = $roleService;
    }

    /** Show all roles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roleService->all();
        return view('admin.dashboard.role.index', compact('roles'));
    }

    /** Show particular role
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('role-show')) {
            $role = $this->roleService->getById($id);
            $permissions = $role->permissions;
            return view('admin.dashboard.role.show', compact('role', 'permissions'));
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    /** Show create role form
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()->hasPermissionTo('role-create')) {
            return view('admin.dashboard.role.create');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    /** Store new Role
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleStoreRequest $request)
    {
        if (Auth::user()->hasPermissionTo('role-create')) {
            $this->roleService->add($request);
            return redirect()->route('role.create')
                ->with('success', 'Роль ' . $request->name . ' була створена!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }
}
