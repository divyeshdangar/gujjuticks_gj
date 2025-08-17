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
                        <h6 class="sub-title">GujjuTicks - Learn, Laugh, Live</h6>

                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'GujjuTicks',
                            '<span class="gradient fw-bolder">GujjuTicks</span>',
                            $metaData['title'],
                        ) !!}</h1>

                        <p class="lead text-muted mb-0">GujjuTicks.com is dedicated to offering a wide array of essential services tailored to meet
                            the needs of the Gujarati community.</p>
                        <p class="lead text-muted mb-0">Whether you require educational resources, healthcare guidance, financial assistance, or
                            legal advice, our platform serves as a one-stop destination for all your requirements.</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img loading="lazy" src="{{ asset('files/images/gujjuticks-map-art.png') }}" alt=""
                            class="home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="position-relative d-none">
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="1440" height="150" preserveAspectRatio="none" viewBox="0 0 1440 220">
                <g mask="url(&quot;#SvgjsMask1004&quot;)" fill="none">
                    <path d="M 0,213 C 288,186.4 1152,106.6 1440,80L1440 250L0 250z" fill="rgba(255, 255, 255, 1)">
                    </path>
                </g>
                <defs>
                    <mask id="SvgjsMask1004">
                        <rect width="1440" height="250" fill="#ffffff"></rect>
                    </mask>
                </defs>
            </svg>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-title text-center">
                        <h3 class="title">Browser Business Categories </h3>
                        <p class="text-muted">Explore a wide range of business categories tailored to your needs. Whether you're searching for local services, professional solutions, or niche products, our categorized listings make it simple to find exactly what you're looking for, all in one place.</p>
                        <p class="text-muted">Discover businesses faster with our smartly organized categories. From trusted local services to specialized solutions, we make it effortless to find exactly what you need, saving you time and helping you connect with the right experts in just a few clicks.</p>
                    </div>
                </div>
            </div>
            <!--end row-->
            <div class="row">
                @foreach ($categories as $data)
                    <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                        <div class="popu-category-box rounded text-center">
                            <img loading="lazy" src="{{ asset('images/cities/category/'.$data->name.'.png') }}" class="w-50">
                            <div class="popu-category-content mt-4">
                                <h5 class="fs-18">{{ $data->label }}</h5>
                                <p class="text-muted mb-0">{{ $data->businesses_count }} Records</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-5 text-center">
                        <a href="{{ route('pages.cities.list') }}" class="btn btn-primary btn-hover">Browse Cities & Businesses</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-5">
                        <h2 class="title mb-3">GujjuTicks Latest Blogs</h2>
                        <p class="text-muted">GujjuTicks Latest Blogs covers everything from Finance & Investment and
                            Health & Wellness to Technology, Real Estate, Legal & Insurance, and more—designed to
                            empower Gujarati readers with practical insights. Dive into expert-led guides on Education, Business & Entrepreneurship, Digital Marketing,
                            Cyber Safety, and Creators & Influencers, all in a crisp, easy-to-understand style.</p>
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
                        <a href="{{ route('pages.blog.list') }}" class="btn btn-primary btn-hover">Browse All Blogs</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

</x-layouts.front>
