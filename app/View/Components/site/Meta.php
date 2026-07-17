<?php

namespace App\View\Components\site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Meta extends Component
{
    public function __construct(
        public array $metaData = [],
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.site.meta');
    }
}
