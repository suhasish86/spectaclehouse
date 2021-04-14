<?php

namespace App\Http\Controllers;

use App\Admin\Brand;
use App\Admin\Page;
use App\Admin\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\FacilityRepositoryInterface;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private $product;
    private $facility;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( ProductRepositoryInterface $product, FacilityRepositoryInterface $facility)
    {
        $this->middleware('guest');
        $this->product = $product;
        $this->facility = $facility;
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
                    $collection = $this->product->get_genre_collection('frame');
                    $trending = $this->product->get_genre_trending('frame');
                    $newest = $this->product->get_genre_collection('frame');
                    $best_deal = $this->product->get_genre_best_deals('frame');
                    return view('site.productlist', compact('collection', 'trending', 'newest', 'best_deal'));
                    break;
                case 'sunglasses':
                    $collection = $this->product->get_genre_collection('sunglass');
                    $trending = $this->product->get_genre_trending('sunglass');
                    $newest = $this->product->get_genre_collection('sunglass');
                    $best_deal = $this->product->get_genre_best_deals('sunglass');
                    return view('site.productlist', compact('collection', 'trending', 'newest', 'best_deal'));
                    break;
                case 'eye-clinic':
                    $eye_clinic = $this->facility->get_facility('eyeclinic');
                    // dd($eye_clinic);
                    return view('site.eyeclinic', compact('eye_clinic'));
                    break;
                case 'services':
                    return view('site.services');
                    break;
                case 'accessories':
                    return view('site.accessories');
                    break;

            }
        }
    }
}
