<?php
namespace App\Repositories;

use App\Admin\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function get_collection()
    {
        $our_collection = Product::where('status', 1)
                                    ->limit(6)
                                    ->with('galleries')
                                    ->get();
        foreach($our_collection as $product){
            $gallery = $product->galleries;
            $cnt = 1;
            foreach($product->galleries as $image){
                if($cnt == 1)
                $product->image = '/storage/uploads/gallery/'.$product->genre.'/'.$image->image;
                $cnt++;
            }
        }
        dd($our_collection);
        return $our_collection;
    }

    public function get_newest()
    {
        $newest_arrival = Product::where('status', 1)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(9)
                                    ->with('galleries')
                                    ->get();
        foreach($newest_arrival as $product){
            $gallery = $product->galleries;
            $cnt = 1;
            foreach($product->galleries as $image){
                if($cnt == 1)
                $product->image = '/storage/uploads/gallery/'.$product->genre.'/'.$image->image;
                $cnt++;
            }
        }
        return $newest_arrival;
    }
}
