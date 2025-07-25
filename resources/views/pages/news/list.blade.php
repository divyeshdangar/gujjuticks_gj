<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <p class="badge text-bg-warning fs-14 mb-2">NEWS on GujjuTicks</p>
                        <h1 class="h2">{{ $metaData['title'] }}</h1>
                        <p class="text-muted mb-5">{{ $metaData['description'] }}</p>

                        @if(false)
                            <img src="{{ URL::asset('/images/cities/' . $dataDetail->image) }}"
                                alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image"
                                class="img-fluid rounded-3 mb-5">
                            <div class="text-muted text-start">
                                {!! $dataDetail->description !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="h3 mb-4">List of NEWS Categories on GujjuTicks</h2>
                </div>
                @foreach ($dataList as $column)
                    <div class="col-lg-4">
                        <div class="card job-Categories-box bg-light border-0">
                            <div class="card-body p-4">
                                <ul class="list-unstyled job-Categories-list mb-0">
                                    @foreach ($column as $category)
                                        <li>
                                            <a href="{{ route('pages.news.detail', ['slug' => $category->slug]) }}"
                                                class="primary-link" style="display: block; overflow: hidden;">
                                                <span class="badge bg-info-subtle text-info me-2 d-none">25</span>
                                                News on {{ $category->name }}
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
