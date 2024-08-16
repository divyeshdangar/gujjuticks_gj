<x-layouts.simple-layout :metaData="$metaData">

    {{-- @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif --}}

    <div class="row justify-content-center mb-2 pb-5">
        <div class="col-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4 pb-0">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="{{ URL::asset('/images/blog/' . $dataDetail->image) }}" class="rounded-3 mb-4">
                        </div>
                        <div class="col-md-9">
                            <h1 class="mb-0 fw-semibold text-dark">{{ $dataDetail->title }}</h1>
                            <p class="mb-4">{!! $dataDetail->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">Recent Blogs</h4>
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
                        <h4 class="fw-bold fs-18 mb-0">Top Categories</h4>
                    </div>
                    <div class="row">
                        @foreach ($categories as $data)
                            <x-common.blocks.category :data="$data"></x-common.breadcrumb>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.simple-layout>
