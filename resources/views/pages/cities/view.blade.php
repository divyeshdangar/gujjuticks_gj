<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-5">
                        <p class="badge bg-warning fs-14 mb-2">Jobs Live Today</p>
                        <h4>Browse Businesses By Categories</h4>
                        <p class="text-muted">Discover local restaurants, salons, tech services, retail stores, and more. Easily find the right provider for your needs.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $column)
                    <div class="col-lg-4">
                        <div class="card job-Categories-box bg-light border-0">
                            <div class="card-body p-4">
                                <ul class="list-unstyled job-Categories-list mb-0">
                                    @foreach ($column as $category)
                                        <li>
                                            <a href="{{ route('pages.cities.businesses.list', ['slug' => $dataDetail->slug, 'category' => str_replace('_', '-', $category->name)]) }}" class="primary-link" style="display: block; overflow: hidden;">
                                                <span class="badge bg-info-subtle text-info me-2 d-none">25</span>
                                                {{ $category->label }} in {{ $dataDetail->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.front>
