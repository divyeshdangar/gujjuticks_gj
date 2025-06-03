<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>


    <!-- START BLOG-PAGE -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="post-preview overflow-hidden rounded-3 mb-3 mb-lg-0">
                        <img src="{{ URL::asset('/images/blog-category/' . $dataDetail->image) }}"
                            alt="{{ $dataDetail->title }} Image" title="{{ $dataDetail->title }} Image"
                            class="img-fluid" />
                    </div>
                </div><!--end col-->
                <div class="col-lg-8">
                    <!-- Post-->
                    <article class="post position-relative">
                        <div class="post ms-lg-4">
                            <h1 class="h3 mb-3">{{ $dataDetail->title }}</h1>
                            <p class="text-muted">
                                {{ $dataDetail->meta_description }}
                            </p>
                            <p>
                                {!! $dataDetail->description !!}
                            </p>
                        </div>
                    </article>
                    <!-- Post end-->
                </div><!--end col-->
            </div>

            <div class="row mt-5">
                @foreach ($dataList as $data)
                    <x-common.blocks.blog :lang="$lang" :data="$data" :class="'col-md-4'"></x-common.breadcrumb>
                @endforeach
                <div class="col-12 text-center">
                    {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
                </div>
            </div>

        </div><!-- end container -->
    </section>
    <!-- END BLOG-PAGE -->

</x-layouts.front>
