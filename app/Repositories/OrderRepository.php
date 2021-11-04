<?php
namespace App\Repositories;

use App\Admin\Billing_address;
use App\Admin\Order;
use App\Admin\Shipping_address;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function save_order($request)
    {
        $order = new Order();
        $order->order_no = time();
        $order->order_total = number_format($request->order_total, 2);
        $order->order_summary = $request->order_summary;

        if($order->save()){
            $billing = $this->build_order_billing($request);
            $shipping = $this->build_order_shipping($request);
            $order->billing_address()->save($billing);
            $order->shipping_address()->save($shipping);
            return $order;
        }
        return false;
    }

    private function build_order_billing($request)
    {
        $billing = new Billing_address();
        $billing->name = $request->billing_name;
        $billing->email = $request->billing_email;
        $billing->phone = $request->billing_phone;
        $billing->address = $request->billing_address;
        $billing->pin = $request->billing_pin;

        return $billing;
    }

    private function build_order_shipping($request)
    {
        $shipping = new Shipping_address();
        $shipping->name = $request->shipping_name;
        $shipping->email = $request->shipping_email;
        $shipping->phone = $request->shipping_phone;
        $shipping->address = $request->shipping_address;
        $shipping->pin = $request->shipping_pin;

        return $shipping;
    }
}
