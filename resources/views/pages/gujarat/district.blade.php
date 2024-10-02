<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h1 class="fw-semibold fs-18 mb-0">{!! $dataDetail->name !!} ({!! $dataDetail->name_gj !!})</h1>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <a target="_blank" href="{{ URL::asset('/images/location/' . $dataDetail->image) }}">
                        <img src="{{ URL::asset('/images/location/' . $dataDetail->image) }}" class="img-fluid rounded-10 mb-4">
                    </a>
                    <p class="mb-4 fw-bold">{!! $dataDetail->meta_description !!}</p>
                </div>
                <div class="col-md-7">
                    {!! $dataDetail->description !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.simple-layout>
