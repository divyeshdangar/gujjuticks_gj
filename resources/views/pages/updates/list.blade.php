<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="section">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="h3 mb-1">Updates Feed</h1>
                    <p class="text-muted mb-0">City-wise and category-wise community updates.</p>
                </div>
                <a href="{{ route('pages.updates.create') }}" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Post Update</a>
            </div>

            <form method="get" class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" placeholder="Search updates..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="city_id">
                                <option value="">All Cities</option>
                                @foreach($cityData as $city)
                                    <option value="{{ $city->id }}" @if((string)request('city_id') === (string)$city->id) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="category_id">
                                <option value="">All Categories</option>
                                @foreach($categoryData as $category)
                                    <option value="{{ $category->id }}" @if((string)request('category_id') === (string)$category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="type">
                                <option value="">All Types</option>
                                @foreach($types as $value => $label)
                                    <option value="{{ $value }}" @if(request('type') === $value) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100">Go</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                @forelse($dataList as $item)
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($item->type === 'image' && $item->image)
                                <img src="{{ asset('images/updates/' . $item->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $item->title }}">
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <span class="badge bg-secondary text-uppercase">{{ $item->type }}</span>
                                        <span class="badge @if($item->privacy === 'public') bg-success @else bg-dark @endif">{{ $item->privacy }}</span>
                                        @if($item->category?->is_important)
                                            <span class="badge bg-danger">Important</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $item->created_at?->diffForHumans() }}</small>
                                </div>
                                <h5 class="card-title mb-1">
                                    <a class="text-dark text-decoration-none" href="{{ route('pages.updates.detail', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                </h5>
                                <div class="small text-muted mb-2">
                                    {{ $item->city?->name }} | {{ $item->category?->name }}
                                </div>
                                @if($item->description)
                                    <p class="text-muted mb-3">{{ Str::limit(strip_tags($item->description), 180) }}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">{{ $item->comments_count }} comments • {{ $item->reactions_count }} reactions</div>
                                    <a href="{{ route('pages.updates.detail', ['slug' => $item->slug]) }}" class="btn btn-outline-primary btn-sm">Open</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <x-common.empty></x-common.empty>
                    </div>
                @endforelse
            </div>

            <div class="mt-2">
                {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
            </div>
        </div>
    </section>
</x-layouts.front>

