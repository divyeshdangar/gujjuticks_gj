<?php

namespace App\View\Components\layouts;

use Closure;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class DashboardLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $metaData,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menu = Menu::where("status", 1)->where('order', '>', 0);
        if(Auth::user()->user_type == 1) {
            // All Access
        } else {
            $in = [];
            if(!empty(Auth::user()->menus)){
                $in = explode(',',Auth::user()->menus->menuIds);
            }
            $menu = $menu->whereIn('id', $in);
        }

        $menu = $menu->orderBy('order', 'ASC')->get();
        return view('components.layouts.dashboard-layout', ["menu" => $menu]);
    }
}
