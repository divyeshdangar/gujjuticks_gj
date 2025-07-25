<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="blog-post">
                        <h3 class="title">{{ $metaData['title'] }}</h3>
                        <p class="text-muted">{{ $metaData['description'] }}</p>
                        @if (count($dataList) > 0)
                            <div class="row mt-4">
                                @foreach ($dataList as $data)
                                    <x-common.blocks.card :data="$data" :class="'col-lg-6 col-md-6 col-sm-6'"></x-common.blocks.card>
                                @endforeach
                                <div class="col-12 text-center">
                                    {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
                                </div>
                            </div>
                        @else
                            <x-common.empty></x-common.empty>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="sidebar ms-lg-4 ps-lg-4 mt-5 mt-lg-0">
                        <div class="pt-2">
                            <div class="sd-title">
                                <h6 class="fs-16 mb-3">Card Categories</h6>
                            </div>
                            <div class="my-3">
                                @foreach ($categories as $key => $value)
                                    <div class="mb-2">
                                        <a href="{{ route('pages.card.category.detail', ['slug' => $value->slug]) }}">{{ $value->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
