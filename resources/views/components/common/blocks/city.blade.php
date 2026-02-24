<div class="col-lg-4 col-md-6">
    <div class="card text-center mb-4 rounded-4">
        <div class="card-body px-2 pt-2 py-4">
            <img loading="lazy" src="{{ URL::asset('/images/cities/' . $data->image) }}" alt="{{ $data->title }} Image" title="{{ $data->title }} Image" class="img-fluid rounded-4">
            <div class="mt-4">
                <a href="{{ route('pages.cities.detail', ['slug' => $data->slug]) }}" class="primary-link">
                    <h6 class="fs-18 mb-2">{{ $data->name }} ({{ $data->name_gj }})</h6>
                </a>
                <p class="text-muted">{{ $data->state }}, {{ $data->country }}</p>
                @if($data->businesses)
                    <p class="text-muted mb-2">{{ $data->businesses->count() }} Businesses</p>
                @endif
            </div>
        </div>
    </div>
</div>