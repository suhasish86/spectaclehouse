<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function get_details($productid);

    public function get_newest();

    public function get_collection();

    public function get_genre_trending($genre);

    public function get_genre_collection($genre);

    public function get_genre_newest($genre);

    public function get_genre_best_deals($genre);





}
