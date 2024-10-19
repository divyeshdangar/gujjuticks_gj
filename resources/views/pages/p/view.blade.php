<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">
    <div class="row justify-content-center mb-2">
        <div class="col-md-8 mb-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-5">
                    <h2><strong>{{ $dataDetail->title }}</strong></h2>
                    <hr>
                    {!! $dataDetail->description !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.simple-layout>
