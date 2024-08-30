<div class="{{ $class }}">
    <div class="card bg-white border-0 rounded-10 mb-4">
        <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}">
            <img src="{{ URL::asset('/images/blog/' . $data->image) }}" class="rounded-2" alt="blog">
        </a>
        <div class="card-body position-relative blog-content m-0 p-3">
            <span class="blog-date two d-inline-block w-auto h-auto lh-1">{{ $lang[$data->lang] }}</span>
            <h4 class="lh-base fs-16 fw-semibold mb-3 mt-4">
                <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}" class="text-decoration-none text-dark">{{ $data->title }}</a>
            </h4>
            <ul class="ps-0 mb-0 list-unstyled d-flex gap-3">
                <li>
                    <i class="ri-user-line text-danger"></i>
                    <a class="text-decoration-none text-gray-light ms-1">{{ ucwords($data->user->name) }}</a>
                </li>
                <li>
                    <i class="ri-calendar-line text-danger"></i>
                    <span class="text-decoration-none text-gray-light ms-1">{{ $data->created_at->format('j F, Y') }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
