<?php

namespace App\View\Components\admin\categories\category;

use Illuminate\View\Component;

class products-table-for-category extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.categories.category.products-table-for-category');
    }
}
