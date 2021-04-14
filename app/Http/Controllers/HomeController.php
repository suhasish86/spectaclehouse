<?php

namespace App\Http\Controllers;

use App\Admin\Brand;
use App\Admin\Page;
use App\Admin\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private $product;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->middleware('guest');
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $our_brands = Brand::where('status', 1)->get();
        $our_collection = $this->product->get_collection();
        $newest_arrival = $this->product->get_newest();

        return view('site.dashboard', compact('our_brands', 'our_collection', 'newest_arrival'));
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
