<x-layouts.simple-layout :metaData="$metaData">
    <div class="row justify-content-center mb-2">
        <div class="col-md-8 mb-4">
            <div class="card bg-white border-0 rounded-10">
                <div class="card-body p-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">Blogs on GujjuTicks</h4>
                    </div>
                    <div class="row">
                        @foreach ($dataList as $data)
                            <x-common.blocks.blog :lang="$lang" :data="$data" :class="'col-lg-4 col-md-6 col-sm-6'"></x-common.breadcrumb>
                        @endforeach
                    </div>
                    {{ $dataList->links('vendor.pagination.bootstrap-5') }}
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
