<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Services\AdminService;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;

class AdminController extends Controller
{
    protected $adminService;
    protected $roleService;

    public function __construct(AdminService $adminService, RoleService $roleService)
    {
        $this->middleware('auth:admin');
        $this->adminService = $adminService;
        $this->roleService = $roleService;
    }

    /** Show all admins
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admins = $this->adminService->all();
        return view('admin.dashboard.admin.index', compact('admins'));
    }

    /** Show Admin
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('admin-show')) {
            $admin = $this->adminService->getById($id);
            $adminRoles = $admin->getRoleNames();
            return view('admin.dashboard.admin.show', compact('admin', 'adminRoles'));
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    /** Store new Admin
     * @param AdminStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminStoreRequest $request)
    {
        if (Auth::user()->hasPermissionTo('admin-create')) {
            $this->adminService->add($request);
            return redirect()->route('admin.index')
                ->with('success', 'Адміністратор ' . $request->name . ' був успішно створений!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (Auth::user()->hasPermissionTo('admin-edit')) {
            $admin = $this->adminService->getById($id);
            $roles = $this->roleService->all();
            $adminRoles = $admin->getRoleNames();
            return view('admin.dashboard.admin.edit', compact('admin', 'adminRoles', 'roles'));
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        if (Auth::user()->hasPermissionTo('admin-edit')) {
            $admin = $this->adminService->updateAdmin($request, $id);
            $this->roleService->assignRoleToAdmin($request,$admin);
            return redirect()->route('admin.index')
                ->with('success', 'Данні адміністратора ' . $admin->name . ' були успішно обновлені!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    /** Delete Admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if (Auth::user()->hasPermissionTo('admin-delete')) {
            $admin = $this->adminService->getById($id);
            $this->adminService->remove($id);
            return redirect()->route('admin.index')
                ->with('success', 'Адміністратор ' . $admin->name . ' був успішно видалений!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }
}
