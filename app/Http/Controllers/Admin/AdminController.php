<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Services\AdminService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $admins = $this->adminService->all();
        return view('admin.dashboard.admin.index', compact('admins'));
    }

    public function store(AdminStoreRequest $request)
    {
        if (Auth::user()->hasPermissionTo('admin-delete')) {
            $this->adminService->add($request);
            return redirect()->route('admin.index')
                ->with('success', 'Адміністратор ' . $request->name . ' був успішно створений!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    public function delete(Request $request)
    {
        if (Auth::user()->hasPermissionTo('admin-delete')) {
            $admin = $this->adminService->getById($request->id);
            $this->adminService->remove($request->id);
            return redirect()->route('admin.index')
                ->with('success', 'Адміністратор ' . $admin->name . ' був успішно видалений!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }
}
