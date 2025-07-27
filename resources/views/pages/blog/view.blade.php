<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="pb-3 me-lg-5">
                        <a href="{{ route('pages.blog.category.detail', ['slug' => $dataDetail->category->slug]) }}">
                            <h6 class="sub-title text-warning">{{ $dataDetail->category->title }}</h6>
                        </a>
                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'GujjuTicks Blogs',
                            '<span class="text-info fw-bold">GujjuTicks Blogs</span>',
                            $dataDetail->title,
                        ) !!}</h1>

                        <p class="lead text-muted mb-0">{{ $dataDetail->meta_description }}</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-5">
                        <img loading="lazy" src="{{ URL::asset('/images/blog/' . $dataDetail->image) }}"
                            alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image"
                            class="home-img w-100 rounded-4" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="blogs">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul class="list-inline mb-5 mt-3 text-muted">
                        <li class="list-inline-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img loading="lazy" src="{{ $dataDetail->user->profile() }}"
                                        alt="{{ ucwords($dataDetail->user->name) }} Profile"
                                        class="avatar-sm rounded-circle">
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">By {{ ucwords($dataDetail->user->name) }}</h6>
                                    {{ $dataDetail->created_at->format('j F, Y') }}
                                </div>
                            </div>
                        </li>
                    </ul>
                    {!! $dataDetail->description !!}
                </div>
                <div class="col-lg-4">
                    <div class="pt-2">
                        <div class="sd-title">
                            <h6 class="fs-16 mb-3">Related Blogs</h6>
                        </div>
                        <div class="my-3">
                            <div class="row">
                                @foreach ($dataList as $data)
                                    <x-common.blocks.blog :lang="$lang" :data="$data"
                                        :class="'col-12'"></x-common.breadcrumb>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <a href="javascript:void(0)"><img loading="lazy"
                                                    src="{{ URL::asset('/images/blog-category/' . $value->image) }}"
                                                    alt="" class="w-100 rounded-4"></a>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div class="candidate-list-content mt-3 mt-lg-0">
                                            <h5 class="fs-19 mb-0"><a
                                                    href="{{ route('pages.blog.category.detail', ['slug' => $value->slug]) }}"
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
