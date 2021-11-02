<?php
namespace App\Repositories;

use App\Admin\Product;
use App\Admin\Inventory;
use App\Admin\ProductGallery;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    public function get_product($product_id){
        return Product::find($product_id);
    }

    public function get_details($productid = false)
    {
        if ($productid) {
            $product = Product::find($productid);
            // $product = Product::where('id', $productid)->first()->get();
            $product->galleries = ProductGallery::where('productid', $productid)->get();
            $product->inventories = Inventory::where('productid', $productid)->get();

            $product->specification = json_decode($product->specification);
            if(!empty($product->galleries)){
                foreach ($product->galleries as $image) {
                    $image->image = asset('/storage/uploads/gallery/' . $product->genre . '/' . $image->image);
                }
            }
            return $product;
        }
        return false;
    }

    public function get_collection()
    {
        $our_collection = Product::where('status', 1)
            ->whereIn('genre', ['frame', 'sunglass'])
            ->limit(6)
            ->has('galleries')
            ->with('galleries')
            ->get();
        foreach ($our_collection as $product) {
            $gallery = $product->galleries;
            $cnt = 1;
            foreach ($product->galleries as $image) {
                if ($cnt == 1) {
                    $product->image = asset('/storage/uploads/gallery/' . $product->genre . '/' . $image->image);
                }

                $cnt++;
            }
        }
        return $our_collection;
    }

    public function get_newest()
    {
        $newest_arrival = Product::where('status', 1)
            ->whereIn('genre', ['frame', 'sunglass'])
            ->orderBy('created_at', 'desc')
            ->limit(9)
            ->has('galleries')
            ->with('galleries')
            ->get();
        foreach ($newest_arrival as $product) {
            $gallery = $product->galleries;
            $cnt = 1;
            foreach ($product->galleries as $image) {
                if ($cnt == 1) {
                    $product->image = asset('/storage/uploads/gallery/' . $product->genre . '/' . $image->image);
                }

                $cnt++;
            }
        }
        return $newest_arrival;
    }

    public function get_genre_trending($genre = false)
    {
        if ($genre) {
            $trending = Product::where('status', 1)
                ->where('genre', $genre)
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->has('galleries')
                ->with('galleries')
                ->get();
            foreach ($trending as $product) {
                $gallery = $product->galleries;
                $cnt = 1;
                foreach ($product->galleries as $image) {
                    if ($cnt == 1) {
                        $product->image = asset('/storage/uploads/gallery/' . $product->genre . '/' . $image->image);
                    }

                    $cnt++;
                }
            }
            return $trending;
        }
        return false;
    }

    public function get_genre_collection($genre = false)
    {
        if ($genre) {
            $collection = Product::where('status', 1)
                ->where('genre', $genre)
                ->limit(3)
                ->has('galleries')
                ->with('galleries')
                ->get();
            foreach ($collection as $product) {
                $gallery = $product->galleries;
                $cnt = 1;
                foreach ($product->galleries as $image) {
                    if ($cnt == 1) {
                        $product->image = asset('/storage/uploads/gallery/' . $product->genre . '/' . $image->image);
                    }

                    $cnt++;
                }
            }
            return $collection;
        }
        return false;
    }

    public function get_genre_best_deals($genre = false)
    {
        if ($genre) {
            $best_deals = Product::where('status', 1)
                ->where('genre', $genre)
                ->limit(4)
                ->has('galleries')
                ->with('galleries')
                ->get();
            foreach ($best_deals as $product) {
                $gallery = $product->galleries;
                $cnt = 1;
                foreach ($product->galleries as $image) {
                    if ($cnt == 1) {
                        $product->image = asset('/storage/uploads/gallery/' . $product->genre . '/' . $image->image);
                    }

                    $cnt++;
                }
            }
            return $best_deals;
        }
        return false;
    }

    public function get_genre_newest($genre = false)
    {
        if ($genre) {
            $newest_arrival = Product::where('status', 1)
                ->where('genre', $genre)
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->has('galleries')
                ->with('galleries')
                ->get();
            foreach ($newest_arrival as $product) {
                $gallery = $product->galleries;
                $cnt = 1;
                foreach ($product->galleries as $image) {
                    if ($cnt == 1) {
                        $product->image = asset('/storage/uploads/gallery/' . $product->genre . '/' . $image->image);
                    }

                    $cnt++;
                }
            }
            return $newest_arrival;
        }
        return false;
    }
}
