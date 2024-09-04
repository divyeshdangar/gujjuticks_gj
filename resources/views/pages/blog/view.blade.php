<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">

    {{-- @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif --}}

    <div class="row mb-2 pb-5">
        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4 pb-0">
                    <h1 class="mb-0 fw-semibold text-dark">{{ $dataDetail->title }}</h1>
                    <img src="{{ URL::asset('/images/blog/' . $dataDetail->image) }}" alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image" class="img-fluid rounded-10 my-4">
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
                    <p class="mb-4">{!! $dataDetail->description !!}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">{{ __('contact.top_categories') }}</h4>
                    </div>
                    <div class="row">
                        @foreach ($categories as $data)
                            <x-common.blocks.category :data="$data" :class="'col-md-12'"></x-common.breadcrumb>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">{{ __('contact.recent_blogs') }}</h4>
                    </div>
                    <div class="row">
                        @foreach ($dataList as $data)
                            <x-common.blocks.blog :lang="$lang" :data="$data" :class="'col-12'"></x-common.breadcrumb>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.simple-layout>
