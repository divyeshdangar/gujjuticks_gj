<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Site extends Component
{
    public function __construct(
        public array $metaData = [],
        public string $page = '',
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.layouts.site');
    }
}
