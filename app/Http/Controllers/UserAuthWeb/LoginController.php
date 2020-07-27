<?php

namespace App\Http\Controllers\UserAuthWeb;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/test';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    /** Use phone credential instead of email
     * @return string
     */
    public function username()
    {
        return 'phone';
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function login()
    {
        return view('user.auth.login');
    }


    public function loginUser(Request $request)
    {
        // Validate the form data
//        $this->validate($request, [
//            'phone'   => 'required|unique:users,phone',
//            'password' => 'required|min:6'
//        ]);
        // Attempt to log the user in
        if (Auth::guard('user')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->get('remember'))) {
            // if successful, then redirect to their intended location
            return redirect()->route('user.dashboard');
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect('user/auth/login')->withInput($request->only('phone', 'remember'))->withErrors([
            'password' => 'Неверный пароль',
            'phone' => 'Неверный логин'
        ]);
    }
}
