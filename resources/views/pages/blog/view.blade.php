<x-layouts.simple-layout :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row justify-content-center mb-5 py-5">
        <div class="col-md-6 text-center">
            <h1 class="fw-bold h2 mb-1">{{ $dataDetail->title }}</h1>
            <span>{{ $dataDetail->created_at->format('j F, Y') }}</span>            
        </div>
        <div class="col-md-8 text-center my-4">
            <img src="{{ URL::asset('/images/blog/' . $dataDetail->image) }}" class="img-fluid rounded-10">
        </div>
        <div class="col-md-6 text-center">
            <p class="mb-4">{!! $dataDetail->description !!}</p>
        </div>
    </div>
</x-layouts.simple-layout>
