<?php

namespace App\View\Components\layouts;

use Closure;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $metaData,
        public $menu = null
    ) {
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menuList = Menu::where("status", 1)->where("type", 2)->where('order', '>', 0);
        if(Auth::user()->user_type == 1) {
            // All Access
        } else {
            $in = [];
            if(!empty(Auth::user()->menus)){
                $in = explode(',',Auth::user()->menus->menuIds);
            }
            $menuList = $menuList->whereIn('id', $in);
        }
    
        $menuList = $menuList->orderBy('order', 'ASC')->get();
        $this->menu = $menuList;
        return view('components.layouts.dashboard');
    }
}
