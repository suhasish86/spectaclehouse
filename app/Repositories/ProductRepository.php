<?php
namespace App\Repositories;

use App\Admin\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
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
                    $product->image = '/storage/uploads/gallery/' . $product->genre . '/' . $image->image;
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
                    $product->image = '/storage/uploads/gallery/' . $product->genre . '/' . $image->image;
                }

                $cnt++;
            }
        }
        return $newest_arrival;
    }

    public function get_genre_trending($genre = false){
        if($genre){
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
                        $product->image = '/storage/uploads/gallery/' . $product->genre . '/' . $image->image;
                    }

                    $cnt++;
                }
            }
        }
        return false;
    }

    public function get_genre_collection($genre = false){
        if($genre){
            $newest_arrival = Product::where('status', 1)
            ->where('genre', $genre)
            ->limit(3)
            ->has('galleries')
            ->with('galleries')
            ->get();
            foreach ($newest_arrival as $product) {
                $gallery = $product->galleries;
                $cnt = 1;
                foreach ($product->galleries as $image) {
                    if ($cnt == 1) {
                        $product->image = '/storage/uploads/gallery/' . $product->genre . '/' . $image->image;
                    }

                    $cnt++;
                }
            }
        }
        return false;
    }

    public function get_genre_best_deals($genre = false){
        if($genre){
            $newest_arrival = Product::where('status', 1)
            ->where('genre', $genre)
            ->limit(4)
            ->has('galleries')
            ->with('galleries')
            ->get();
            foreach ($newest_arrival as $product) {
                $gallery = $product->galleries;
                $cnt = 1;
                foreach ($product->galleries as $image) {
                    if ($cnt == 1) {
                        $product->image = '/storage/uploads/gallery/' . $product->genre . '/' . $image->image;
                    }

                    $cnt++;
                }
            }
        }
        return false;
    }

    public function get_genre_newest($genre = false){
        if($genre){
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
                        $product->image = '/storage/uploads/gallery/' . $product->genre . '/' . $image->image;
                    }

                    $cnt++;
                }
            }
        }
        return false;
    }
}
