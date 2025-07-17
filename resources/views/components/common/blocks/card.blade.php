<div class="{{ $class }} mb-4">
    <div class="card blog-grid-box p-2">
        <div class="row">
            <div class="col-6">
                <img height="1080" width="1920" src="{{ URL::asset('/images/card/' . $data->front_image) }}" alt="{{ $data->title }} Image" title="{{ $data->title }} Image" class="img-fluid rounded-3">
            </div>
            <div class="col-6">
                <img height="1080" width="1920" src="{{ URL::asset('/images/card/' . $data->back_image) }}" alt="{{ $data->title }} Image" title="{{ $data->title }} Image" class="img-fluid rounded-3">
            </div>
        </div>
        <div class="card-body p-1 pt-3">
            <a href="{{ route('pages.card.detail', ['slug' => $data->slug]) }}" class="primary-link">
                <span class="fs-17 h6">{{ $data->title }}</span>
            </a>
            <p class="text-muted">
                {{ $data->meta_description }}
            </p>
            <a class="btn btn-success w-100" href="">Order on Whatsapp</a>
        </div>
    </div>
</div>
