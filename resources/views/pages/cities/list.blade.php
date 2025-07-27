<x-layouts.front :showHeader="true" :metaData="$metaData">


    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Explore Cities on GujjuTicks</h6>

                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'City Directory',
                            '<span class="text-warning fw-bold">City Directory</span>',
                            $metaData['title'],
                        ) !!}</h1>

                        <p class="lead text-muted mb-0">{{ $metaData['description'] }}</p>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0 h-100">
                                <a class="btn btn-warning" href="#cities" style="color: rgb(19, 19, 19) !important;">Start Exploring</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img loading="lazy" src="{{ URL::asset('/images/creative/gujarat.png') }}" alt="Gujarat Image"
                            title="Gujarat Image" class="rounded-4 home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="cities">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Explore & Discover: 50 Cities from Gujarat</h2>
                        <p class="text-muted mb-5">Uncover the vibrant essence of Gujarat through its top 50 cities.
                            From historical landmarks to modern hubs, each city has a unique story, culture, and charm
                            waiting to be explored. Whether you're planning a trip or simply curious, this guide offers
                            a quick glimpse into the diverse spirit of Gujarat's landscape.</p>
                    </div>
                </div>
            </div>
            <div class="blog-post">
                @if (count($dataList) > 0)
                    <div class="row">
                        @foreach ($dataList as $data)
                            <x-common.blocks.city :data="$data"></x-common.blocks.city>
                        @endforeach
                        <div class="col-12 text-center">
                            {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
                        </div>
                    </div>
                @else
                    <x-common.empty></x-common.empty>
                @endif
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-muted">
                    <h2 class="text-warning text-center mb-4">More on Listing</h2>
                    <p class="text-muted text-start">
                        Welcome to your ultimate guide for exploring vibrant cities across India and Gujarat. From the
                        historic lanes of Ahmedabad and the royal palaces of Jaipur to the bustling markets of Mumbai
                        and the serene backwaters near Kochi, our list spans every corner of the subcontinent. Whether
                        you’re seeking architectural wonders, culinary adventures, or off-the-beaten-path experiences,
                        you’ll find inspiration here. Each city entry includes a snapshot of its must-see landmarks,
                        local culture highlights, and seasonal events to help you craft the perfect itinerary.
                    </p>

                    <p class="text-muted text-start">
                        Navigate our interactive directory to filter cities by region, theme, or traveler
                        interest - heritage, food, nightlife, wellness, and more. Dive into detailed overviews that
                        cover
                        practical travel tips (best time to visit, transport options, and accommodation ranges), insider
                        recommendations, and hidden gems recommended by local experts. Bookmark your favorite
                        destinations, compare cities side-by-side, and start planning a journey that’s tailored to your
                        passions. Adventure awaits in every city - let us help you explore them all.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.front>
