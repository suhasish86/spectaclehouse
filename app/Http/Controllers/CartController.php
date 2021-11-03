<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('shopping-cart', compact('cartItems'));
    }

    public function add_to_cart(Request $request)
    {
        $error = '';
        $user_cart = false;
        $cart_product = $this->product->get_product($request->product_id);
        if(Auth::check()){
            try{
                $user_cart = \Cart::session($request->user()->id)->add(array(
                    'id' => $request->product_id,
                    'name' => $request->product_name,
                    'price' => $request->product_price,
                    'quantity' => $request->product_quantity,
                    'attributes' => array(),
                    'associatedModel' => $cart_product
                ));
            }
            catch(Exception $e){
                $error = $e->getMessage();
            }
        } else {
            try{
                $user_cart = \Cart::session($request->product_id)->add(array(
                    'id' => $request->product_id,
                    'name' => $request->product_name,
                    'price' => $request->product_price,
                    'quantity' => $request->product_quantity,
                    'attributes' => array(),
                    'associatedModel' => $cart_product
                ));
            }
            catch(Exception $e){
                $error = $e->getMessage();
            }
        }
        if ($request->ajax()) {
            return ($user_cart) ?
            response()->json([
                'status' => 'success',
                'message' => 'Item added to cart.',
            ]
            ) :
            response()->json([
                'status' => 'failed',
                'message' => 'Can not process cart.',
                'Error' => $error
            ]
            );
        } else {
            return ($user_cart) ?
            back()->with('error', $error) :
            back()->with('success', 'Item added to cart');
        }
    }
}
