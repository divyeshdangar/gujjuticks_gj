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
                            $dataDetail->title,
                        ) !!}</h1>

                        <p class="lead text-muted mb-0">{{ $metaData['description'] }}</p>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0 h-100">
                                <a class="btn btn-warning" href="#cities"
                                    style="color: rgb(19, 19, 19) !important;">Start Exploring</a>
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
                        <h2 class="text-warning mb-4">Explore {{ $dataDetail->name }}’s Business Landscape</h2>
                        <p class="text-muted mb-5">{{ $dataDetail->name }} is home to a wide variety of businesses that contribute to
                            its growing economy and vibrant local community. From small enterprises to large
                            establishments, the city offers opportunities across multiple sectors. This section
                            highlights a diverse collection of businesses operating in {{ $dataDetail->name }}, making it easier to
                            explore local services, connect with providers, or gain insight into the city’s commercial
                            environment.</p>
                    </div>
                </div>
            </div>
            <div class="">
                @if (count($categories) > 0)
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-3 col-6 text-center mb-5">
                                <div class="rounded-4 border p-2 py-3">
                                    <a href="{{ route('pages.cities.businesses.list', ['slug' => $dataDetail->slug, 'category' => str_replace('_', '-', $category->name)]) }}" class="primary-link" style="display: block; overflow: hidden;">                                    
                                        <img loading="lazy" src="{{ URL::asset('/images/cities/category/'.$category->name.'.png') }}" class="border p-3 rounded-4 mb-2 bg-warning" alt="" title="Gujjuticks {{ $category->label }} image" height="128px" width="128px">
                                        <div class="">{{ $category->label }} in {{ $dataDetail->name }}</div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
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
                @if (count($dataList) > 0)
                    <div class="row">
                        @foreach ($dataList as $data)
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
                <div class="col-lg-12 text-muted">
                    <h2 class="text-warning text-center mb-4">Quick Guide to {{ $dataDetail->name }} City</h2>
                    <p class="text-muted text-start">
                        {!! $dataDetail->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-muted">
                    <h2 class="text-warning text-center mb-4">{{ $dataDetail->name_gj }} શહેર વિશે થોડી માહિતી</h2>
                    <p class="text-muted text-start">
                        {!! $dataDetail->description_gj !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
