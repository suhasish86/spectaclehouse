<?php

namespace App\Http\Controllers;

use App\Admin\Page;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('site.dashboard');
    }


    /**
     * Navigate Application
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function process(Page $page)
    {
        if(isset($page->pageslug)){
            switch($page->pageslug){
                case 'frames':
                    return view('site.dashboard');
                    break;
            }
        }
        // return view('site.dashboard');
    }
}
