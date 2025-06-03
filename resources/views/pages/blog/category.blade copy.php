<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">

    {{-- @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif --}}

    <div class="row justify-content-center mb-2 pb-5">
        <div class="col-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4 pb-0">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="{{ URL::asset('/images/blog-category/' . $dataDetail->image) }}" alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image" class="rounded-3 mb-4">
                        </div>
                        <div class="col-md-9">
                            <h1 class="mb-0 fw-semibold text-dark">{{ $dataDetail->title }}</h1>
                            <p class="mb-4">{!! $dataDetail->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (false)
            <div class="col-md-12">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                            <h4 class="fw-bold fs-18 mb-0">{{ __('contact.sub_categories') }}</h4>
                        </div>
                        <div class="row">
                            @foreach ($subCategories as $data)
                                <x-common.blocks.category :data="$data" :class="'col-md-4'"></x-common.breadcrumb>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">{{ __('contact.recent_blogs') }}</h4>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($dataList as $data)
                            <x-common.blocks.blog :lang="$lang" :data="$data" :class="'col-md-4'"></x-common.breadcrumb>
                        @endforeach
                    </div>
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
        </div>
    </div>
</x-layouts.simple-layout>
