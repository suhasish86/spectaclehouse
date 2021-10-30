<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index(Request $request)
    {
        $user = $request->user();
        return view('site.my-account', compact('user'));
    }
}
