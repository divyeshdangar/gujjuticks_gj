<div class="col-lg-4 col-md-6">
    <div class="card text-center mb-4">
        <div class="card-body px-2 pt-2 py-4">
            <img src="{{ URL::asset('/images/cities/' . $data->image) }}" alt="" class="img-fluid rounded-3">
            <div class="mt-4">
                <a href="{{ route('pages.cities.detail', ['slug' => $data->slug]) }}" class="primary-link">
                    <h6 class="fs-18 mb-2">{{ $data->name }}</h6>
                </a>
                <p class="text-muted mb-4">{{ $data->state }}, {{ $data->country }}</p>
                <a href="{{ route('pages.cities.detail', ['slug' => $data->slug]) }}" class="btn btn-primary">{{ $data->businesses->count() }} Businesses</a>
            </div>
        </div>
    </div>
</div>