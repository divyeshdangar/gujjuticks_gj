<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">
    <div class="row justify-content-center mb-2">
        <div class="col-md-8 mb-4">
            <div class="card bg-white border-0 rounded-10">
                <div class="card-body p-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">{{ __('contact.blogs_on') }}</h4>
                    </div>

                    @if(count($dataList) > 0)
                        <div class="row">
                            @foreach ($dataList as $data)
                                <x-common.blocks.blog :lang="$lang" :data="$data" :class="'col-lg-6 col-md-6 col-sm-6'"></x-common.breadcrumb>
                            @endforeach
                        </div>
                        {{ $dataList->links('vendor.pagination.bootstrap-5') }}                    
                    @else
                        <x-common.empty></x-common.empty>
                    @endif
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
