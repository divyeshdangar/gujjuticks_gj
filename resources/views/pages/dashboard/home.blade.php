<x-layouts.dashboard :showHeader="true" :metaData="$metaData">
    <div class="row justify-content-center">
        
        <div class="col-12">
            @if (isset($menu))
                @if(count($menu) > 0)
                    <div class="row mb-5">
                        @foreach ($menu as $m)
                            @if ($m['title_only'] == 1)
                                <div class="col-12">
                                    <div class="menu-title-text fw-bold fs-5 mb-1 mt-3">{{ __($m['title']) }}</div>
                                </div>
                            @else
                                <div class="col-md-3">
                                    <div class="stats-box style-two card bg-white border-0 rounded-10 mb-2">
                                        <a href="{{ route($m['route']) }}" class="text-decoration-none {{ Request::routeIs($m['route']) ? 'rounded-10 border border-2' : '' }}">
                                        <div class="card-body p-4">                                            
                                            <h3 class="body-font text-muted fs-6 mb-0"><i data-feather="{{ $m['icon'] }}" class=""></i> {{ __($m['title']) }}</h3>                                            
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                @endif
            @endif
        </div>
    </div>
</x-layouts.dashboard>