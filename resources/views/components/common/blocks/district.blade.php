<div class="{{ $class }}">
    <div class="style-five bg-eef0fa card border-0 rounded-10 mb-4" style="background: url('{{ $data->image_link() }}') no-repeat center; background-size:cover;">
        <div class="card-body p-4 py-5 rounded-10" style="background-color: rgba(0, 0, 0, 0.7)">
            <a class="text-decoration-none" href="{{ route('pages.gujarat.district', ['slug' => $data->slug]) }}"><h2 class="fs-3 fw-bold text-light">{{ $data->name }}</h2></a>
            <h3 class="text-white fs-5">{{ $data->name_gj }}</h3>
            <div class="text-white">{{ $data->meta_description }}</div>
        </div>
    </div>
</div>
