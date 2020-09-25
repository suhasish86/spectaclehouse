<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function product()
    {
        return $this->belongsTo('App\Admin\Product', 'productid');
    }

    /**
     * Get the post that owns the comment.
     */
    public function inventory()
    {
        return $this->belongsTo('App\Admin\Inventory', 'inventoryid');
    }
}
