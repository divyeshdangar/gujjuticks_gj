<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="mb-4 pb-2 me-lg-4">
                        <h6 class="sub-title">Local news & community alerts</h6>
                        @if($activeCategory)
                            <h1 class="display-5 fw-semibold mb-3"><span class="text-warning fw-bold">{{ $activeCategory->name }}</span> Updates</h1>
                            <p class="lead text-muted mb-0">Browse {{ Str::lower($activeCategory->name) }} posts from your city community. Filter by city or post type, or search within this category.</p>
                        @else
                            <h1 class="display-5 fw-semibold mb-3"><span class="text-warning fw-bold">City Updates</span> – Share what matters in your area</h1>
                            <p class="lead text-muted mb-0">Discover city-wise updates on festivals, events, emergencies, jobs, lost & found, polls, and community Q&amp;A. Post publicly or keep updates private.</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="btn btn-warning me-2" href="#updates-feed" style="color: rgb(19, 19, 19) !important;">Browse feed</a>
                    <a class="btn btn-outline-light" href="{{ route('pages.updates.create') }}">Post update</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="updates-feed">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    @if($activeCategory)
                        <x-updates.breadcrumb class="mb-3" :items="[
                            ['label' => 'Updates', 'url' => route('pages.updates.list')],
                            ['label' => $activeCategory->name],
                        ]" />
                    @endif

                    <form method="get" action="{{ $listAction }}" class="mb-4">
                        @if($activeCity)
                            <input type="hidden" name="city" value="{{ $activeCity->slug }}">
                        @endif
                        @if(request('type'))
                            <input type="hidden" name="type" value="{{ request('type') }}">
                        @endif
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by title or description..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Search</button>
                        </div>
                    </form>

                    @php
                        $hasFilters = request()->filled('search') || $activeCity || request()->filled('type') || $activeCategory;
                        $filterWithoutCity = collect($filterQuery)->except('city')->all();
                    @endphp

                    @if($hasFilters)
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                            <span class="small text-muted">Active filters:</span>
                            @if($activeCategory)
                                <a href="{{ route('pages.updates.list', $filterQuery) }}" class="badge bg-warning text-decoration-none" style="color: rgb(19, 19, 19) !important;">{{ $activeCategory->name }} ×</a>
                            @endif
                            @if(request('search'))
                                <span class="badge bg-secondary">Search: {{ request('search') }}</span>
                            @endif
                            @if($activeCity)
                                <a href="{{ $activeCategory ? route('pages.updates.category', array_merge(['slug' => $activeCategory->slug], $filterWithoutCity)) : route('pages.updates.list', $filterWithoutCity) }}" class="badge bg-secondary text-decoration-none">City: {{ $activeCity->name }} ×</a>
                            @endif
                            @if(request('type'))
                                <span class="badge bg-secondary">Type: {{ $types[request('type')] ?? request('type') }}</span>
                            @endif
                            <a href="{{ route('pages.updates.list') }}" class="small text-warning">Clear all</a>
                        </div>
                    @endif

                    @if($dataList->count() > 0)
                        <p class="text-muted small mb-3">Showing {{ $dataList->firstItem() }}–{{ $dataList->lastItem() }} of {{ $dataList->total() }} updates</p>
                        <div class="row">
                            @foreach($dataList as $item)
                                <div class="col-12 mb-4">
                                    <x-updates.card :item="$item" />
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-2">
                            {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
                        </div>
                    @else
                        <x-common.empty></x-common.empty>
                        <div class="text-center mt-3">
                            <a href="{{ route('pages.updates.create') }}" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Be the first to post</a>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4 col-md-5">
                    <x-updates.filters-sidebar :cityData="$cityData" :categoryData="$categoryData" :types="$types" :activeCategory="$activeCategory" :activeCity="$activeCity" :listAction="$listAction" :filterQuery="$filterQuery" />
                </div>
            </div>

            <div class="row mt-5 pt-4 border-top">
                <div class="col-lg-10 mx-auto">
                    <h3 class="h4 mb-3">What you can post</h3>
                    <div class="row g-3">
                        @foreach($types as $value => $label)
                            <div class="col-sm-6 col-md-4">
                                <div class="p-3 rounded border h-100">
                                    <x-updates.type-badge :type="$value" class="mb-2" />
                                    <p class="text-muted small mb-0">
                                        @switch($value)
                                            @case('status') Text updates for announcements and news. @break
                                            @case('image') Photo updates with optional description. @break
                                            @case('youtube') Embed a YouTube video for your community. @break
                                            @case('poll') Ask the community to vote on options. @break
                                            @case('qa') Collect answers to a community question. @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.front>
