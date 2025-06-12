<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <p class="badge text-bg-warning fs-14 mb-2">Businesses on GujjuTicks</p>
                        <h1 class="h2">{{ $businessCategory->label }} in {{ $dataDetail->name }}</h1>
                        <p class="text-muted">{{ $metaData["description"] }}</p>

                        @foreach(explode("___||___", $businessCategory->getDescription($dataDetail->name)) as $key => $value)
                            <p class="text-muted">{{ $value }}</p>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-8">                    
                    <div>
                        <h2 class="h3 mb-5">List of {{ Str::plural($businessCategory->label) }} in {{ $dataDetail->name }} city</h2>
                        @if (count($dataList) > 0)
                                @foreach ($dataList as $data)
                                    <x-common.blocks.business :data="$data" :dataDetail="$dataDetail"></x-common.blocks.business>
                                @endforeach
                                <div class="text-center mt-4">
                                    {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
                                </div>
                            </div>
                        @else
                            <x-common.empty></x-common.empty>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
