<?php

namespace App\Http\Controllers;

use App\Admin\Brand;
use App\Admin\Page;
use App\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $our_brands = Brand::where('status', 1)->get();
        $our_collection = Product::where('status', 1)->limit(10)->with('galleries')->get();
        $newest_arrival = Product::where('status', 1)->orderBy('created_at', 'desc')->limit(6)->with('galleries')->get();

        foreach($our_collection as $product){
            $gallery = $product->galleries;
            $cnt = 1;
            foreach($product->galleries as $image){
                if($cnt == 1)
                $product->image = '/storage/uploads/gallery/'.$product->genre.'/'.$image->image;
                $cnt++;
            }
        }

        foreach($newest_arrival as $product){
            $gallery = $product->galleries;
            $cnt = 1;
            foreach($product->galleries as $image){
                if($cnt == 1)
                $product->image = '/storage/uploads/gallery/'.$product->genre.'/'.$image->image;
                $cnt++;
            }
        }

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
