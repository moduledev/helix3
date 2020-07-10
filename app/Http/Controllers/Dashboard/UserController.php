<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /** Shows all users
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userService->all();
        return view('admin.dashboard.user.index', compact('users'));
    }
    public function store(UserStoreRequest $request)
    {
        if (Auth::user()->hasPermissionTo('user-create')) {
            $this->userService->add($request);
            return redirect()->route('user.index')
                ->with('success', 'Користувач ' . $request->name . ' був успішно створений!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

    public function delete(Request $request)
    {
        if (Auth::user()->hasPermissionTo('admin-delete')) {
            $admin = $this->userService->getById($request->id);
            $this->userService->remove($request->id);
            return redirect()->route('admin.index')
                ->with('success', 'Адміністратор ' . $admin->name . ' був успішно видалений!');
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }

}
