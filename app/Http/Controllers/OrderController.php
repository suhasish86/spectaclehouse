<?php

namespace App\Http\Controllers;

use App\Admin\Order;
use App\Http\Requests\OrderRequest;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    protected $user, $order, $razorpayId, $razorpayKey;


    public function __construct(UserRepositoryInterface $user, OrderRepositoryInterface $order)
    {
        $this->user = $user;
        $this->order = $order;
        $this->razorpayId = 'rzp_test_ZqbSpHcl9zHGfr';
        $this->razorpayKey = 'qPMmw5g3gJRLrqsV114t7wQT';
    }

    public function place_order(OrderRequest $request)
    {

        //Check if User
        $registered_user = $this->user->get_user_by_email($request->billing_email);

        $cart_summary = [];
        $order_total = \Cart::getTotal();
        $cartItems = \Cart::getContent();

        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                $product = [
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'sku' => $item->attributes->sku,
                    'price' => $item->price
                ];
                $cart_summary[] = $product;
            }
        }

        $request->order_total = $order_total;
        $request->order_summary = $cart_summary;

        $valid = $this->SignatureVerify(
            $request->rzp_signature,
            $request->rzp_paymentid,
            $request->rzp_orderid
        );

        if ($valid == true) {
            $request->payment_status = 'paid';
        } else {
            $request->payment_status = 'failed';
        }

        $order = $this->order->save_order($request);
        if ($request->ajax()) {
            return ($valid) ?
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
            return ($valid) ?
            back()->with('success', 'Order successfully created.') :
            back()->with('failed', 'Order creation failed.');
        }
    }

    public function order_success(Order $order)
    {
        $cartItems = \Cart::getContent();
        $user_cart = \Cart::clear();
        if ($order->id) {
            $order->purchase_date = Carbon::parse($order->created_at)->format('l jS, F Y h:i A');

            // dd($order->billing_address->email);

            //Mail User
            $mail_data = (object) [
                'cart' => $cartItems,
                'order' => $order,
                'mail_to' => $order->billing_address->email,
            ];
            // $user_mail = MailController::sendOrderEmail($mail_data);

            //Mail Admin
            $mail_data = (object) [
                'cart' => $cartItems,
                'order' => $order,
                // 'mail_to' => 'info@spectaclehouse.in'
                'mail_to' => 'suhasish86@gmail.com',
            ];
            // $admin_email = MailController::sendAdminOrderEmail($mail_data);

            return view('site.thank_you', compact('cartItems', 'order'));
        } else {
            return abort('403');
        }

    }

    private function SignatureVerify($_signature, $_paymentId, $_orderId)
    {
        try
        {
            // Create an object of razorpay class
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $attributes = array('razorpay_signature' => $_signature, 'razorpay_payment_id' => $_paymentId, 'razorpay_order_id' => $_orderId);
            $order = $api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (\Exception $e) {
            // If Signature is not correct its give a excetption so we use try catch
            echo $e->getMessage();
            return false;
        }
    }
}
