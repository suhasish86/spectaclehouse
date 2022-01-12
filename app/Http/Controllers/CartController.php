<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $product, $razorpayId, $razorpayKey;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
        $this->razorpayId = 'rzp_test_ZqbSpHcl9zHGfr';
        $this->razorpayKey = 'qPMmw5g3gJRLrqsV114t7wQT';
    }

    public function index()
    {
        $cartItems = \Cart::getContent();
        return view('site.shopping-cart', compact('cartItems'));
    }

    public function add_to_cart(Request $request)
    {
        $error = '';
        $user_cart = false;
        $cart_product = $this->product->get_product($request->product_id);
        try{
            $user_cart = \Cart::add(array(
                'id' => $request->product_id,
                'name' => $request->product_name,
                'price' => $request->product_price,
                'quantity' => $request->product_quantity,
                'attributes' => array(
                    'sku' => $cart_product->productsku,
                    'slug' => $cart_product->productslug,
                    'image' => $request->product_image,
                ),
                'associatedModel' => $cart_product
            ));
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
        if ($request->ajax()) {
            return ($user_cart) ?
            response()->json([
                'status' => 'success',
                'message' => 'Item added to cart.',
            ]
            ) :
            response()->json([
                'status' => 'error',
                'message' => 'Can not process cart.',
                'error' => $error
            ]
            );
        } else {
            return ($user_cart) ?
            back()->with('error', $error) :
            back()->with('success', 'Item added to cart');
        }
    }

    public function update_cart(Request $request)
    {
        $error = '';
        $user_cart = false;
        try{
            $user_cart = \Cart::update(
                $request->itemid,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $request->item_quantity
                    ],
                ]
            );
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
        if ($request->ajax()) {
            return ($user_cart) ?
            response()->json([
                'status' => 'success',
                'message' => 'Item updated on cart.',
            ]
            ) :
            response()->json([
                'status' => 'error',
                'message' => 'Can not process cart.',
                'error' => $error
            ]
            );
        } else {
            return ($user_cart) ?
            back()->with('error', $error) :
            back()->with('success', 'Item updated on cart');
        }
    }

    public function remove_cart_item(Request $request)
    {
        $error = '';
        $user_cart = false;
        try{
            $user_cart = \Cart::remove($request->itemid);
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
        if ($request->ajax()) {
            return ($user_cart) ?
            response()->json([
                'status' => 'success',
                'message' => 'Cart item has been removed.',
            ]
            ) :
            response()->json([
                'status' => 'error',
                'message' => 'Cart item removal failed.',
                'error' => $error
            ]
            );
        } else {
            return ($user_cart) ?
            back()->with('error', 'Cart item removal failed') :
            back()->with('success', 'Cart item has been removed');
        }
    }

    public function clear_cart(Request $request)
    {
        $error = '';
        $user_cart = false;
        try{
            $user_cart = \Cart::clear();
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
        if ($request->ajax()) {
            return ($user_cart) ?
            response()->json([
                'status' => 'success',
                'message' => 'Cart has been cleared.',
            ]
            ) :
            response()->json([
                'status' => 'error',
                'message' => 'Cart clearing failed.',
                'error' => $error
            ]
            );
        } else {
            return ($user_cart) ?
            back()->with('error', 'Cart clearing failed') :
            back()->with('success', 'Cart hs been cleared');
        }
    }


    public function checkout(Request $request){
        $cartItems = \Cart::getContent();
        $order_total = \Cart::getTotal();
        $receiptId = Str::random(20);
        $api = new Api($this->razorpayId, $this->razorpayKey);



        // Creating order
        $order = $api->order->create([
            'receipt' => $receiptId,
            'amount' => $order_total * 100,
            'currency' => 'INR',
        ]);

        // Return response on payment page
        $razorpay = [
            'orderId' => $order['id'],
            'receipt_id' => $receiptId,
            'razorpayId' => $this->razorpayId,
            'amount' => $order_total * 100,
            'currency' => 'INR',
            'logo' => asset('siteassets/img/logo.png')
        ];
        return view('site.checkout', compact('cartItems', 'razorpay'));
    }
}
