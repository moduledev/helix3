<?php

namespace App\Http\Controllers\User;

use App\HelixDb;
use App\Http\Controllers\Controller;
use App\Services\HelixService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard.index');
    }

    public function search()
    {
        return view('user.dashboard.search');
    }

}
