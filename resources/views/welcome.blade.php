<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="bg-home" id="home">
        {{-- <div class="bg-overlay"></div> --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white mb-5">
                        <h1 class="display-5 fw-semibold mb-3">Search Between More Then <span
                                class="text-warning fw-bold">70,000+</span>
                            Businesses and more.</h1>
                        <p class="fs-17 fw-bold text-warning">
                            WE WILL LIVE SOON
                        </p>

                        <p class="fs-17">
                            GujjuTicks.com is dedicated to offering a wide array of essential services tailored to meet
                            the needs of the Gujarati community.
                        </p>
                        <p class="fs-17">
                            Whether you require educational resources, healthcare guidance, financial assistance, or
                            legal advice, our platform serves as a one-stop destination for all your requirements.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="position-relative">
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

    @if (true)
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <h3 class="title">Browser Business Categories </h3>
                            <p class="text-muted">Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                        </div>
                    </div>
                </div>
                <!--end row-->
                <div class="row">
                    @foreach ($categories as $data)
                        <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                            <div class="popu-category-box rounded text-center">
                                <div class="popu-category-icon icons-md">
                                    <i class="uim uim-layers-alt"></i>
                                </div>
                                <div class="popu-category-content mt-4">
                                    <a href="javascript:void(0)" class="text-dark stretched-link">
                                        <h5 class="fs-18">{{ $data->label }}</h5>
                                    </a>
                                    <p class="text-muted mb-0">{{ $data->businesses_count }} Records</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mt-5 text-center">
                            <a href="job-categories.html" class="btn btn-primary btn-hover">Browse All Categories <i
                                    class="uil uil-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="section">
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

        </div>
    </section>

</x-layouts.front>
