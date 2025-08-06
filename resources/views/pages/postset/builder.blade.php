<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Boost your professional image</h6>
                        <h1 class="display-5 fw-semibold mb-3">{{ $dataDetail->title }}</h1>
                        <p class="lead text-muted mb-0">{{ $dataDetail->meta_description }}</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img src="{{ route('pages.image.postmain', ['slug' => $dataDetail->slug . '.jpg']) }}"
                            alt="" class="home-img w-100 rounded-4" alt="{{ $dataDetail->title }}"
                            title="{{ $dataDetail->title }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-4">
                    <div class="section-title mb-5">
                        <h3 class="title text-warning">Discover Curated Visual Stories</h3>
                        <p class="text-muted">Explore a growing collection of creative posts covering history, culture,
                            lifestyle, and more. Each set is uniquely crafted with engaging content and dynamic visuals,
                            designed to inform, inspire, and spark curiosity. Dive into the stories that matter - one
                            post at a time.</p>
                    </div>
                </div>
                @if ($dataDetail && $dataDetail->posts && count($dataDetail->posts) > 0)
                    @foreach ($dataDetail->posts as $key => $value)
                        <div class="col-lg-4 mb-4">
                            <img src="{{ route('pages.image.postset', ['slug' => $value->slug . '.jpg']) }}"
                                class="rounded-4 w-100 mb-3" alt="{{ $value->title }}" title="{{ $value->title }}">
                            <h3 class="h4">{{ $value->title }}</h3>
                            <p class="text-muted">{{ $value->description }}</p>
                        </div>
                    @endforeach
                @else
                @endif

            </div>
        </div>
    </section>

</x-layouts.front>
