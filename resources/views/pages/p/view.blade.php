<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="pb-3 me-lg-5">
                        <h6 class="sub-title text-warning">GujjuTicks Pages</h6>
                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'GujjuTicks Blogs',
                            '<span class="text-info fw-bold">GujjuTicks Blogs</span>',
                            $dataDetail->title,
                        ) !!}</h1>

                        <p class="lead text-muted mb-0">{{ $dataDetail->meta_description }}</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-5">
                        <img loading="lazy" src="{{ URL::asset('/images/pages/' . $dataDetail->image) }}"
                            alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image"
                            class="home-img w-100 rounded-4" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="blogs">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul class="list-inline mb-5 mt-3 text-muted">
                        <li class="list-inline-item">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">Last Updated: {{ $dataDetail->updated_at->format('j F, Y') }}</h6>                                
                            </div>
                        </li>
                    </ul>
                    {!! $dataDetail->description !!}
                </div>
            </div>
        </div>
    </section>
</x-layouts.front>
