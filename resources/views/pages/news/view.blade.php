<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <p class="badge text-bg-warning fs-14 mb-2">NEWS on GujjuTicks</p>
                        <h1 class="h2">News on {{ $dataDetail->name }}</h1>
                        <p class="text-muted mb-5">{{ $dataDetail->meta_description }}</p>
                        <img src="{{ URL::asset('/images/news/' . $dataDetail->image) }}"
                                alt="{{ $dataDetail->name }} Image" title="{{ $dataDetail->name }} Image"
                                class="img-fluid rounded-3 mb-5">
                        <div class="text-muted text-start">
                            {!! $dataDetail->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    @foreach($dataList as $key => $value)
                        <a href="{{ route("pages.news.detail", ["slug" => $value->slug]) }}" class="btn btn-sm btn-warning my-1 mx-1" style="color: black !important">{{ $value->name }}</a>
                    @endforeach
                </div>

                <div class="col-lg-12">                    
                    <h2 class="h3 mb-4">List of {{ $dataDetail->name }} News</h2>
                    @if (count($dataListNews) > 0)
                        <div class="row">
                            @foreach ($dataListNews as $data)
                                <x-common.blocks.news :data="$data" :class="'col-md-6'" :dataDetail="$dataDetail"></x-common.blocks.news>
                            @endforeach
                            <div class="text-center mt-4">
                                {{ $dataListNews->links('vendor.pagination.bootstrap-5-new') }}
                            </div>
                        </div>
                    @else
                        <x-common.empty></x-common.empty>
                    @endif
                </div>
            </div>
        </div>
    </section>


</x-layouts.front>
