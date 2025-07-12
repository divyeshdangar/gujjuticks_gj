<div class="{{ $class }}">
    <div class="job-box bookmark-post card mb-5">
        <div class="p-4">
            <img src="{{ route('pagpages.image.cool', ['slug' => 'characters-' . CommonHelper::getInitials($data->title) . '.jpg']) }}"
                alt="" class="img-fluid rounded-3">
            <h3 class="h4 my-3 text-dark" style="display: inline-block">
                {!! $data->title !!}
            </h3>
            <p class="text-muted fs-14 mb-0">{!! $data->content !!}</p>
        </div>
    </div>
</div>
