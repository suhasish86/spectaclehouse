<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'order_summary' => 'array',
    ];

    public function billing_address(){
        return $this->hasOne(\App\Admin\Billing_address::class);
    }

    public function shipping_address(){
        return $this->hasOne(\App\Admin\Shipping_address::class);
    }
}
