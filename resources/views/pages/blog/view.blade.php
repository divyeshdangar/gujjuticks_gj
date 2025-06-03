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
                        <p class="text-danger fw-semibold mb-0">{{ $dataDetail->category->title }}</p>
                        <h1 class="h2">{{ $dataDetail->title }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-post">
                        <img src="{{ URL::asset('/images/blog/' . $dataDetail->image) }}"
                            alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image"" alt=""
                            class="img-fluid rounded-3">

                        <ul class="list-inline mb-0 mt-3 text-muted">
                            <li class="list-inline-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $dataDetail->user->profile() }}"
                                            alt="{{ ucwords($dataDetail->user->name) }} Profile"
                                            class="avatar-sm rounded-circle">
                                    </div>
                                    <div class="ms-3">
                                        <a href="blog-author.html" class="primary-link">
                                            <h6 class="mb-0">By {{ ucwords($dataDetail->user->name) }}</h6>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="uil uil-calendar-alt"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0"> {{ $dataDetail->created_at->format('j F, Y') }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
                                        <a
                                            href="{{ route('pages.blog.category.detail', ['slug' => $value->slug]) }}">{{ $value->title }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4">
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
        </div>
    </section>


</x-layouts.front>
