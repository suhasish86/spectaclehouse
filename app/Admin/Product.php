<?php

namespace App\Admin;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;

    /**
     * Get the invetory for products.
     */
    public function inventories()
    {
        return $this->hasMany('App\Admin\Inventory', 'productid');
    }

    /**
     * Get the galleries for products.
     */
    public function galleries()
    {
        return $this->hasMany('App\Admin\ProductGallery', 'productid');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('productname')
            ->saveSlugsTo('productslug');
    }
}
