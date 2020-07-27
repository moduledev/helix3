<?php

namespace App\Http\Controllers\UserAuthApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!$token = auth('api')->attempt($request->only('phone','password'))){
            return response(null, 401);
        }
        return response()->json(compact('token'));
    }
}
