<?php

namespace App\Http\Controllers\Helix;

use App\Http\Controllers\Controller;
use App\Services\HelixService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelixController extends Controller
{
    protected $helixService;

    public function __construct(HelixService $helixService)
    {
        $this->middleware('auth:admin')->only('getDbsStatus');
        $this->helixService = $helixService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDbs()
    {
        return response()->json($this->helixService->getDbs());
    }


    public function dbStatus()
    {
        if (Auth::user()->hasPermissionTo('admin-show')) {
            $dbs = $this->helixService->isDbEnable();
            return  view('admin.dashboard.db.index', compact('dbs'));
        } else {
            return redirect()->back()->with('error', 'У Вас нема прав для виконання операції');
        }
    }


    public function tableColumnslist(Request $request)
    {
        return response()->json($this->helixService->getTableColumns($request->nameDb));
    }

    public function getSearch(Request $request)
    {
         return response()->json($request->columns);
    }
}
