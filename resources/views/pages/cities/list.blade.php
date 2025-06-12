<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-8">
                    <div class="mb-3 mb-lg-0">
                        <h6 class="fs-16 mb-0"> {{ $dataList->total(); }} cities </h6>
                    </div>
                </div>
            </div>

            @if (count($dataList) > 0)
                <div class="row">
                    @foreach ($dataList as $data)
                        <x-common.blocks.city :data="$data"></x-common.blocks.city>
                    @endforeach
                    <div class="col-12 text-center">
                        {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
                    </div>
                </div>
            @else
                <x-common.empty></x-common.empty>
            @endif
        </div>
    </section>
</x-layouts.front>
