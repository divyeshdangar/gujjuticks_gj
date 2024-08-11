<x-layouts.simple-layout :metaData="$metaData">

    {{-- @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif --}}

    <div class="row justify-content-center mb-2 py-5">
        <div class="col-md-6">
            <h1 class="fw-bold h2 mb-1 text-center">{{ $dataDetail->title }}</h1>
        </div>
        <div class="col-md-8 text-center my-4">
            <img src="{{ URL::asset('/images/blog/' . $dataDetail->image) }}" class="img-fluid rounded-10">
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <ul class="ps-0 mb-4 list-unstyled chat-list">
                <li class="d-flex justify-content-between border-bottom border-color-gray pb-3 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 position-relative">
                            <img src="{{ $dataDetail->user->profile }}" class="wh-48 rounded-circle"
                                alt="user">
                            <div
                                class="position-absolute p-1 bg-primary border border-2 border-white rounded-circle status-position2">
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-10">
                            <h4 class="fs-16 fw-semibold mb-1">{{ ucwords($dataDetail->user->name) }}</h4>
                            <span class="fs-14 text-success">{{ $dataDetail->user->username }}</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="d-block fs-14 text-gray-light">{{ $dataDetail->created_at->format('j F, Y') }}</span>
                        <span class="d-block fs-14 text-info">1000 views | {{ $lang[$dataDetail->lang] }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6 text-center">
            <p class="mb-4">{!! $dataDetail->description !!}</p>
        </div>
        <div class="col-md-8 mt-5">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4 pb-0">
                    <div class="border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-sm-0">Recent Blogs</h4>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($dataList as $data)
                            <div class="col-md-4">
                                <div class="card bg-white border-0 rounded-10 mb-4">
                                    <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}">
                                        <img src="{{ URL::asset('/images/blog/' . $data->image) }}" class="rounded-2" alt="blog">
                                    </a>
                                    <div class="card-body position-relative blog-content m-0 p-3">
                                        <span class="blog-date two d-inline-block w-auto h-auto lh-1">{{ $lang[$data->lang] }}</span>
                                        <h4 class="lh-base fs-16 fw-semibold mb-3 mt-4">
                                            <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}" class="text-decoration-none text-dark">{{ $data->title }}</a>
                                        </h4>
                                        <ul class="ps-0 mb-0 list-unstyled d-flex gap-3">
                                            <li>
                                                <i class="ri-user-line text-danger"></i>
                                                <a href="#" class="text-decoration-none text-gray-light ms-1">By {{ ucwords($data->user->name) }}</a>
                                            </li>
                                            <li>
                                                <i class="ri-calendar-line text-danger"></i>
                                                <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}" class="text-decoration-none text-gray-light ms-1">{{ $data->created_at->format('j F, Y') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.simple-layout>
