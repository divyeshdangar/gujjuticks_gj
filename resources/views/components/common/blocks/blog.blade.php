<div class="{{ $class }} mb-4">
    <div class="card blog-grid-box p-2">
        <img src="{{ URL::asset('/images/blog/' . $data->image) }}" alt="{{ $data->title }} Image" title="{{ $data->title }} Image" class="img-fluid">
        <div class="card-body">

            @if($class != "col-12")                
                <ul class="list-inline d-flex justify-content-between mb-3">
                    <li class="list-inline-item">
                        <p class="text-muted mb-0">
                            @if ($data->user)
                                <a href="blog-author.html" class="text-muted fw-medium">{{ ucwords($data->user->name) }}</a> -                         
                            @endif
                            {{ $data->created_at->format('j F, Y') }}</p>
                    </li>
                    <li class="list-inline-item d-none">
                        <p class="text-muted mb-0"><i class="mdi mdi-eye"></i> 432</p>
                    </li>
                </ul>
            @endif
            <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}" class="primary-link">
                <h6 class="fs-17">{{ $data->title }}</h6>
            </a>
            <p class="text-muted">
                {{ $data->meta_description }}
            </p>
            <div>
                <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}" class="form-text text-primary">Read More <i class="uil uil-angle-right-b"></i></a>
            </div>
        </div>
    </div><!--end blog-grid-box-->
</div><!--end col-->
