@props(['dataDetail', 'cityFilterQuery' => [], 'typeFilterQuery' => [], 'categoryData'])

<div class="card border shadow-sm mb-4">
    <div class="card-body p-4">
        <h3 class="h6 text-muted text-uppercase mb-3">Explore updates</h3>
        <ul class="list-unstyled mb-0 small">
            <li class="mb-2">
                <a href="{{ route('pages.updates.list') }}" class="text-warning text-decoration-none">All community updates</a>
            </li>
            @if($dataDetail->category)
                <li class="mb-2">
                    <a href="{{ route('pages.updates.category', ['slug' => $dataDetail->category->slug]) }}" class="text-decoration-none">
                        More {{ $dataDetail->category->name }} updates
                    </a>
                </li>
            @endif
            @if($dataDetail->city)
                <li class="mb-2">
                    <a href="{{ route('pages.updates.list', $cityFilterQuery) }}" class="text-decoration-none">
                        Updates in {{ $dataDetail->city->name }}
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('pages.cities.detail', ['slug' => $dataDetail->city->slug]) }}" class="text-decoration-none">
                        About {{ $dataDetail->city->name }}
                    </a>
                </li>
            @endif
            @if($dataDetail->category && $dataDetail->city)
                <li class="mb-2">
                    <a href="{{ route('pages.updates.category', array_merge(['slug' => $dataDetail->category->slug], $cityFilterQuery)) }}" class="text-decoration-none">
                        {{ $dataDetail->category->name }} in {{ $dataDetail->city->name }}
                    </a>
                </li>
            @endif
            <li class="mb-2">
                <a href="{{ route('pages.updates.list', $typeFilterQuery) }}" class="text-decoration-none">
                    More {{ $types[$dataDetail->type] ?? ucfirst($dataDetail->type) }} posts
                </a>
            </li>
        </ul>

        @if($categoryData->isNotEmpty())
            <hr class="my-3">
            <p class="small text-muted mb-2">Browse by category</p>
            <div class="d-flex flex-wrap gap-1">
                @foreach($categoryData->take(8) as $cat)
                    <a href="{{ route('pages.updates.category', ['slug' => $cat->slug]) }}" class="badge @if($dataDetail->category && $dataDetail->category->id === $cat->id) bg-warning text-dark @else bg-secondary @endif text-decoration-none">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
