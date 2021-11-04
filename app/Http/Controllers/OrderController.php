<?php

namespace App\Http\Controllers;

use App\Admin\Order;
use App\Http\Requests\OrderRequest;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $user, $order;

    public function __construct(UserRepositoryInterface $user, OrderRepositoryInterface $order){
        $this->user = $user;
        $this->order = $order;
    }

    public function place_order(OrderRequest $request){

        //Check if User
        $registered_user = $this->user->get_user_by_email($request->billing_email);

        $cart_summary = [];
        $order_total = \Cart::getTotal();
        $cartItems = \Cart::getContent();

        if(!empty($cartItems)){
            foreach($cartItems as $item){
                $product = [
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'sku' => $item->attributes->sku
                ];
                $cart_summary[] = $product;
            }
        }

        $request->order_total = $order_total;
        $request->order_summary = $cart_summary;

        $order = $this->order->save_order($request);
        if ($request->ajax()) {
            return ($order) ?
            response()->json([
                'status' => 'success',
                'order_no' => $order->order_no,
                'message' => 'Order successfully created.',
            ]
            ) :
            response()->json([
                'status' => 'failed',
                'message' => 'Order creation failed.',
            ]
            );
        } else {
            return ($order) ?
            back()->with('success', 'Order successfully created.') :
            back()->with('failed', 'Order creation failed.');
        }
    }

    public function order_success(Order $order)
    {
        $cartItems = \Cart::getContent();
        $user_cart = \Cart::clear();
        if($order->id){
            $order->purchase_date = Carbon::parse($order->created_at)->format('l jS, F Y h:i A');

            // dd($order->billing_address->email);

            //Mail User
            $mail_data = (object)[
                'cart' => $cartItems,
                'order' => $order,
                'mail_to' => $order->billing_address->email
            ];
            $user_mail = MailController::sendOrderEmail($mail_data);

            //Mail Admin
            $mail_data = (object)[
                'cart' => $cartItems,
                'order' => $order,
                // 'mail_to' => 'orders@spectaclehouse.in'
                'mail_to' => 'suhasish86@gmail.com'
            ];
            $admin_email = MailController::sendAdminOrderEmail($mail_data);

            return view('site.thank_you', compact('cartItems', 'order'));
        } else {
            return abort('403');
        }

    }
}
