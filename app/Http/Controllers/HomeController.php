<?php

namespace App\Http\Controllers;

use App\Admin\Brand;
use App\Admin\Page;
use App\Admin\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\FacilityRepositoryInterface;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\MailController;


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
     * Show the product details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Product $product)
    {
        $product = $this->product->get_details($product->id);
        return view('site.product-details', compact('product'));
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
                case 'lense':
                    $collection = $this->product->get_genre_collection('lense');
                    $trending = $this->product->get_genre_trending('lense');
                    $newest = $this->product->get_genre_collection('lense');
                    $best_deal = $this->product->get_genre_best_deals('lense');
                    return view('site.productlist', compact('collection', 'trending', 'newest', 'best_deal'));
                    break;
                case 'contact-lense':
                    $collection = $this->product->get_genre_collection('contactlense');
                    $trending = $this->product->get_genre_trending('contactlense');
                    $newest = $this->product->get_genre_collection('contactlense');
                    $best_deal = $this->product->get_genre_best_deals('contactlense');
                    return view('site.productlist', compact('collection', 'trending', 'newest', 'best_deal'));
                    break;
                case 'eye-clinic':
                    $eye_clinic = $this->facility->get_facility('eyeclinic');
                    return view('site.eyeclinic', compact('eye_clinic'));
                    break;
                case 'services':
                    $services = $this->facility->get_facility('services');
                    return view('site.services', compact('services'));
                    break;
                case 'accessories':
                    return view('site.accessories');
                    break;

            }
        }
    }

    public function contact(Request $request){
        return view('site.contact');
    }

    public function contact_process(ContactRequest $request){
        $mail_data = [
            'mail_to' => $request->contact_email,
            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'contact_message' => $request->contact_message,
        ];
        $user_mail = MailController::sendContactEmail($mail_data);
        return ($user_mail) ?
            response()->json([
                'status' => 'success',
                'message' => 'Contact request sent.',
            ]
            ) :
            response()->json([
                'status' => 'error',
                'message' => 'Sorry! something went wrong, please try again.',
            ]
            );
    }
}
