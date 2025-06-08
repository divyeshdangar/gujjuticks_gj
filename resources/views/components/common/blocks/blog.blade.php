<div class="{{ $class }} mb-4">
    <div class="card blog-grid-box p-2">
        <img height="1080" width="1920" src="{{ URL::asset('/images/blog/' . $data->image) }}" alt="{{ $data->title }} Image" title="{{ $data->title }} Image" class="img-fluid">
        <div class="card-body">

            @if($class != "col-12")                
                <ul class="list-inline d-flex justify-content-between mb-3">
                    <li class="list-inline-item">
                        <p class="text-muted mb-0">
                            @if ($data->user)
                                <span class="text-muted fw-medium">{{ ucwords($data->user->name) }}</span> -                         
                            @endif
                            {{ $data->created_at->format('j F, Y') }}</p>
                    </li>
                    <li class="list-inline-item d-none">
                        <p class="text-muted mb-0"><i class="mdi mdi-eye"></i> 432</p>
                    </li>
                </ul>
            @endif
            <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}" class="primary-link">
                <span class="fs-17 h6">{{ $data->title }}</span>
            </a>
            <p class="text-muted">
                {{ $data->meta_description }}
            </p>
        </div>
    </div><!--end blog-grid-box-->
</div><!--end col-->
