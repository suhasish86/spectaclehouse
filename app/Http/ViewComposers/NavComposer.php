<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

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
        $this->navList = [
            'Shawshank redemption',
            'Forrest Gump',
            'The Matrix',
            'Pirates of the Carribean',
            'Back to the future',
        ];
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // $view->with('navList', $this->navList);
    }
}
