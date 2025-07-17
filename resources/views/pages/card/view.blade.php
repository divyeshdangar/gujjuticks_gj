<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <a href="{{ route('pages.card.category.detail', ['slug' => $dataDetail->category->slug]) }}" class="text-warning fw-semibold mb-0">{{ $dataDetail->category->title }}</a>
                        <h1 class="h2">{{ $dataDetail->title }}</h1>
                        <p class="text-muted">{{ $dataDetail->meta_description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-post">
                        
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ URL::asset('/images/card/' . $dataDetail->front_image) }}" alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image" class="img-fluid rounded-3">
                                <div class="fw-bold mt-2 text-center">Card Front Side</div>
                            </div>
                            <div class="col-6">
                                <img src="{{ URL::asset('/images/card/' . $dataDetail->back_image) }}" alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image" class="img-fluid rounded-3">
                                <div class="fw-bold mt-2 text-center">Card Back Side</div>
                            </div>
                        </div>


                        <div class="mt-4">
                            {!! $dataDetail->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="sidebar ms-lg-4 ps-lg-4 mt-5 mt-lg-0">
                        <div class="pt-2">
                            <div class="sd-title">
                                <h6 class="fs-16 mb-3">Categories</h6>
                            </div>
                            <div class="my-3">
                                @foreach ($categories as $key => $value)
                                    <div class="mb-2">
                                        <a href="{{ route('pages.card.category.detail', ['slug' => $value->slug]) }}">{{ $value->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4">
                            <div class="sd-title">
                                <h6 class="fs-16 mb-3">Related Cards</h6>
                            </div>
                            <div class="my-3">
                                <div class="row">
                                    @foreach ($dataList as $data)
                                        <x-common.blocks.card :data="$data"
                                            :class="'col-12'"></x-common.breadcrumb>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-layouts.front>
