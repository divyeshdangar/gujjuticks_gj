<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Businesses on GujjuTicks</h6>

                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            $dataDetail->name,
                            '<span class="text-warning fw-bold">' . $dataDetail->name . '</span>',
                            $metaData['title'],
                        ) !!}</h1>

                        <p class="lead text-muted mb-0">{{ $metaData['description'] }}</p>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0 h-100">
                                <a class="btn btn-warning" href="#businesses"
                                    style="color: rgb(19, 19, 19) !important;">Start Exploring</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0 text-center">
                        <img loading="lazy"
                            src="{{ URL::asset('/images/cities/category/' . $businessCategory->name . '.png') }}"
                            alt="Gujarat Image" title="Gujarat Image" class="rounded-4 home-img" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="businesses">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">{{ $dataDetail->name }}
                            {{ Str::plural($businessCategory->label) }} Business Finder</h2>
                        <p class="text-muted mb-5">Looking for trusted {{ Str::plural($businessCategory->label) }} in {{ $dataDetail->name }}? You’re in the right place. This section helps you discover reliable and verified businesses operating in {{ $dataDetail->name }}, making it easy to find services that match your needs. Whether you're a local resident or a visitor, our curated listings connect you with top-rated professionals and companies in the {{ Str::plural($businessCategory->label) }} space.</p>                        
                    </div>
                </div>
            </div>
            <div class="">
                @if (count($dataList) > 0)
                    @foreach ($dataList as $data)
                        <x-common.blocks.business :data="$data" :dataDetail="$dataDetail"></x-common.blocks.business>
                    @endforeach
                    <div class="text-center mt-4">
                        {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
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
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Other Famous Cities in Gujarat You Should Know</h2>
                        <p class="text-muted mb-5">Gujarat is a land of diverse cities, each offering its own unique
                            blend of culture, history, and modern development. These urban centers are known for their
                            distinctive local flavors, traditions, and contributions to the state’s identity. Whether
                            you're a traveler, researcher, or simply curious, exploring these cities gives you a deeper
                            understanding of Gujarat’s dynamic and evolving landscape.</p>
                    </div>
                </div>
            </div>
            <div class="blog-post">
                @if (count($citiesList) > 0)
                    <div class="row">
                        @foreach ($citiesList as $data)
                            <x-common.blocks.city :data="$data"></x-common.blocks.city>
                        @endforeach
                    </div>
                @else
                    <x-common.empty></x-common.empty>
                @endif
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">More on {{ Str::plural($businessCategory->label) }} in {{ $dataDetail->name }}, {{ $dataDetail->state }}</h2>
                        @foreach(explode("___||___", $businessCategory->getDescription($dataDetail->name)) as $key => $value)
                            <p class="text-muted">{{ $value }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
