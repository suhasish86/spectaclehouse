<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Admin\Page;

class NavComposer
{
    public $navList = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->navList = Page::where('status', 1)->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->navList = Page::where('status', 1)->get();
        $view->with('navList', $this->navList);
    }
}
