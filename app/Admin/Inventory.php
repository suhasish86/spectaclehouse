<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function product()
    {
        return $this->belongsTo('App\Admin\Product', 'productid');
    }

    /**
     * Get the galleries for products.
     */
    public function galleries()
    {
        return $this->hasMany('App\Admin\ProductGallery', 'inventoryid');
    }
}
