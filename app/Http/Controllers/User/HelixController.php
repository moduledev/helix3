<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\HelixService;
use Illuminate\Http\Request;

class HelixController extends Controller
{
    protected $helixService;

    public function __construct(HelixService $helixService)
    {
        $this->helixService = $helixService;
    }

    public function getDbs()
    {
        return response()->json($this->helixService->getDbs());
    }

}
