<x-layouts.front :showHeader="true" :metaData="$metaData">

    <style>
        .gradient {
            background: -webkit-linear-gradient(#FF8008, #FFC837);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 me-lg-5">
                        <h1 class="display-5 fw-semibold mb-3">
                            <span class="gradient fw-bolder">GujjuTicks</span>
                        </h1>
                        <p class="lead text-white mb-3">Software, tech products, and AI tools — built to ship.</p>
                        <p class="lead text-muted mb-4">We design and build digital products for businesses that need reliable software and practical AI. Tell us what you want to create next.</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('form.contact') }}" class="btn btn-primary btn-hover">Start a project</a>
                            <a href="#what-we-build" class="btn btn-outline-light btn-hover">What we build</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img loading="lazy" src="{{ asset('files/images/gujjuticks-map-art.png') }}" alt="GujjuTicks"
                            class="home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light" id="what-we-build">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-0">
                        <h2 class="title mb-3">What we build</h2>
                        <p class="text-muted mb-0">Custom software, product features, and AI-assisted experiences — from idea to a working release. If you need a partner to design, build, or extend a digital product, we are ready to talk.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('form.contact') }}" class="btn btn-primary btn-hover">Talk to us</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-5">
                        <h2 class="title mb-3">Insights</h2>
                        <p class="text-muted">Notes on software, AI, and building products — from the GujjuTicks team.</p>
                    </div>
                </div>
            </div>

            @if (isset($dataList) && count($dataList) > 0)
                <div class="row">
                    @foreach ($dataList as $data)
                        <x-common.blocks.blog :lang="$lang" :data="$data"
                            :class="'col-lg-4 col-md-4 col-sm-12'"></x-common.blocks.blog>
                    @endforeach
                </div>
            @else
                <x-common.empty></x-common.empty>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-5 text-center">
                        <a href="{{ route('pages.blog.list') }}" class="btn btn-primary btn-hover">Browse all blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
