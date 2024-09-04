<div class="{{ $class }}">
    <div class="d-flex align-items-center rounded-3 bg-gray-div2 p-3 p-sm-2 p-md-3 mb-15">
        <div class="flex-shrink-0">
            <img src="{{ URL::asset('/images/blog-category/' . $data->image) }}" class="rounded-3 wh-44" alt="{{ $data->title }} Image" title="{{ $data->title }} Image">
        </div>
        <div class="flex-grow-1 ms-10">
            <a href="{{ route('pages.blog.category.detail', ['slug' => $data->slug]) }}" class="mb-0 fw-semibold fs-16 text-dark text-decoration-none">{{ $data->title }}</a>
            <p class="text-gray">{{ $data->meta_description }}</p>
        </div>
    </div>
</div>