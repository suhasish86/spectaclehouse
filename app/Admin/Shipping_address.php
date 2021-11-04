<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Shipping_address extends Model
{
    public function order(){
        return $this->belongsTo(\App\Admin\Order::class);
    }
}
