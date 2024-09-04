<?php

namespace App\View\Components\layouts;

use Closure;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $metaData;
    public $menu = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $metaData, $menu = null
    ) {
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {        
        return view('components.layouts.dashboard');
    }
}
