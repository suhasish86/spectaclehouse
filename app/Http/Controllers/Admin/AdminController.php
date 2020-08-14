<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Traits\RegisterUser;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;

class AdminController extends Controller
{
    use RegisterUser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showlogin()
    {
        if (Auth::check())
            return redirect()->route('admin.dashboard');
        else
            return view('admin.login');
    }

    public function register(RegistrationRequest $request)
    {
        $user = $this->registerUser($request);
        return redirect()->route('admin.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $attributes = $request->only(['email', 'password']);
        if (Auth::attempt($attributes)) {
            if($request->ajax())
                return response()->json([
                    'status' => 'success',
                    'message'=>'Redirecting....'
                    ]
                );
            else
                return redirect()->route('admin.dashboard');
        } else {
            if($request->ajax())
                return response()->json([
                    'status' => 'warning',
                    'message'=>'Invalid Login, please check details.'
                    ]
                );
            else
                return redirect()->route('admin.login');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return back();
    }

}
