<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">GujjuTalks - Read, Relate, Repeat</h6>

                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'GujjuTicks Blogs',
                            '<span class="text-info fw-bold">GujjuTicks Blogs</span>',
                            $metaData['title'],
                        ) !!}</h1>

                        <p class="lead text-muted mb-0">{{ $metaData['description'] }}</p>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0 h-100">
                                <a class="btn btn-info" href="#blogs" style="color: rgb(19, 19, 19) !important;">Start
                                    Reading</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img loading="lazy" src="{{ asset('files/images/blogs-listing-page.png') }}" alt=""
                            class="home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="blogs">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Latest from GujjuTicks</h2>
                        <p class="text-muted mb-5">Welcome to the heart of GujjuTicks! Here you’ll find fresh, engaging,
                            and informative blog posts covering everything from trending topics to everyday tips.
                            Whether you're looking to stay updated, learn something new, or simply enjoy a good read -
                            our blog section has something for everyone.</p>
                    </div>
                </div>
            </div>
            <div class="blog-post">
                @if (count($dataList) > 0)
                    <div class="row">
                        @foreach ($dataList as $data)
                            <x-common.blocks.blog :lang="$lang" :data="$data"
                                :class="'col-lg-4 col-md-4 col-sm-6'"></x-common.blocks.blog>
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
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Explore Our Blog Categories</h2>
                        <p class="text-muted mb-5">Discover content that matters to you! From local news and tech
                            updates to lifestyle tips and cultural insights, our blog categories are tailored to keep
                            you informed, inspired, and entertained. Dive into the topics you love and stay connected
                            with what’s happening in and around Gujarat.</p>
                    </div>
                </div>
            </div>
            <div class="row text-start">
                <div class="candidate-list">
                    @foreach ($categories as $key => $value)
                        <div class="candidate-list-box card mt-4">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <div class="candidate-list-images">
                                            <a href="javascript:void(0)"><img loading="lazy" src="{{ URL::asset('/images/blog-category/' . $value->image) }}"
                                                    alt="" class="w-100 rounded-4"></a>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div class="candidate-list-content mt-3 mt-lg-0">
                                            <h5 class="fs-19 mb-0"><a href="{{ route('pages.blog.category.detail', ['slug' => $value->slug]) }}"
                                                    class="primary-link">{{ $value->title }}</a> <span
                                                    class="badge bg-success ms-1">{{ $value->blogs_count }}</span></h5>
                                            <p class="text-muted my-2">{{ $value->meta_description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
