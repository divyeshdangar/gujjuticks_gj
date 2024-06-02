<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

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
        $menu = [
            [
                "id" => 1,
                "title" => "",
                "menu" => [
                    [
                        "icon" => "grid",
                        "route" => "dashboard",
                        "title" => __('dashboard.dashboard'),
                    ],
                ],
            ]
        ];
        print_r($menu);
        die;
        return view('components.layouts.dashboard-layout', ["menu" => $menu]);
    }
}
