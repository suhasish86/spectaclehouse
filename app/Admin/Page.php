<?php

namespace App\Admin;

use App\Traits\OrderingHandler;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasSlug;
    use OrderingHandler;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('pagename')
            ->saveSlugsTo('pageslug');
    }

}
