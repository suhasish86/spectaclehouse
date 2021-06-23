<?php

namespace App\Traits;

use App\Admin\Page;
//use Illuminate\Database\Eloquent\Model;

trait OrderingHandler
{

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function bootOrderingHandler()
    {
        static::creating(function ($model) {
            if (empty($model->ordering)) {
                $maxOrdering = Page::max('ordering');
                $model->ordering = $maxOrdering + 1;
            }
        });

    }

}
