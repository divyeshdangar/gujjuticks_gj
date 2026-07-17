@props(['cityData', 'categoryData', 'types', 'activeCategory' => null, 'activeCity' => null, 'listAction', 'filterQuery' => []])

<div class="sidebar ms-lg-4 ps-lg-4 mt-4 mt-lg-0">
    <div class="card border shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fs-16 mb-3">Filter updates</h6>
            <form method="get" action="{{ $listAction }}">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <label class="form-label small text-muted mb-1">City</label>
                <select class="form-select form-select-sm mb-3" name="city" onchange="this.form.submit()">
                    <option value="">All cities</option>
                    @foreach($cityData as $city)
                        <option value="{{ $city->slug }}" @selected($activeCity && $activeCity->id === $city->id)>{{ $city->name }}</option>
                    @endforeach
                </select>

                <label class="form-label small text-muted mb-1">Post type</label>
                <select class="form-select form-select-sm mb-3" name="type" onchange="this.form.submit()">
                    <option value="">All types</option>
                    @foreach($types as $value => $label)
                        <option value="{{ $value }}" @selected(request('type') === $value)>{{ $label }}</option>
                    @endforeach
                </select>

                <label class="form-label small text-muted mb-2">Category</label>
                <div class="mb-0">
                    <div class="mb-2">
                        <a href="{{ route('pages.updates.list', $filterQuery) }}" class="@if(!$activeCategory) fw-bold text-warning @endif">All categories</a>
                    </div>
                    @foreach($categoryData as $category)
                        <div class="mb-2 d-flex align-items-center gap-2">
                            <a href="{{ route('pages.updates.category', array_merge(['slug' => $category->slug], $filterQuery)) }}" class="@if($activeCategory && $activeCategory->id === $category->id) fw-bold text-warning @endif">
                                {{ $category->name }}
                            </a>
                            @if($category->is_important)
                                <span class="badge bg-danger" style="font-size: 0.65rem;">Alert</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>

    <div class="card border shadow-sm">
        <div class="card-body">
            <h6 class="fs-16 mb-2">Share your update</h6>
            <p class="text-muted small mb-3">Post news, alerts, polls, or questions for your city community.</p>
            <a href="{{ route('pages.updates.create') }}" class="btn btn-warning w-100" style="color: rgb(19, 19, 19) !important;">Post an update</a>
        </div>
    </div>
</div>
