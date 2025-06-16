<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="text-center mb-5">
                    <p class="badge text-bg-warning fs-14 mb-2">Explore Cities on GujjuTicks</p>
                    <h1 class="h2">{{ $metaData['title'] }}</h1>
                    <p class="text-muted mb-5">{{ $metaData['description'] }}</p>
                    <img src="{{ URL::asset('/images/creative/gujarat.png') }}" alt="Gujarat Image" title="Gujarat Image" class="img-fluid rounded-3 mb-5">
                    <p class="text-muted">
                        Welcome to your ultimate guide for exploring vibrant cities across India and Gujarat. From the
                        historic lanes of Ahmedabad and the royal palaces of Jaipur to the bustling markets of Mumbai
                        and the serene backwaters near Kochi, our list spans every corner of the subcontinent. Whether
                        you’re seeking architectural wonders, culinary adventures, or off-the-beaten-path experiences,
                        you’ll find inspiration here. Each city entry includes a snapshot of its must-see landmarks,
                        local culture highlights, and seasonal events to help you craft the perfect itinerary.
                    </p>

                    <p class="text-muted">
                        Navigate our interactive directory to filter cities by region, theme, or traveler
                        interest - heritage, food, nightlife, wellness, and more. Dive into detailed overviews that cover
                        practical travel tips (best time to visit, transport options, and accommodation ranges), insider
                        recommendations, and hidden gems recommended by local experts. Bookmark your favorite
                        destinations, compare cities side-by-side, and start planning a journey that’s tailored to your
                        passions. Adventure awaits in every city - let us help you explore them all.
                    </p>
                </div>
            </div>

            @if (count($dataList) > 0)
                <div class="row">
                    <div class="col-12">
                        <h2 class="h3 mb-4">List of {{ $dataList->total() }} cities</h2>
                    </div>
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
    </section>
</x-layouts.front>
