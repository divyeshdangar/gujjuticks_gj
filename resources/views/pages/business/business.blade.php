<x-layouts.front :showHeader="true" :metaData="$metaData">

    <style>
        .cr-boundary {
            border-radius: 15px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">List It. Get Noticed | GujjuTicks</h6>

                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'Business Directory',
                            '<span class="text-warning fw-bold">Business Directory</span>',
                            $metaData['title'],
                        ) !!}</h1>

                        <p class="lead text-muted mb-4">{{ $metaData['description'] }}</p>

                        <p class="lead text-muted mb-0">
                            <b class="fw-bold text-warning">Discover trusted businesses in your city.</b></br>
                            Browse our local business directory to find shops, services, and professionals near you.
                            GujjuTicks makes it easy to compare options, get contact details, and connect with reliable
                            local businesses - helping you make confident decisions faster.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img loading="lazy" src="{{ URL::asset('/images/creative/Local-Business-Directory-Trusted-Businesses-on-GujjuTicks.jpg') }}" alt="Trusted Local Business Directory on GujjuTicks"
                            title="Trusted Local Business Directory on GujjuTicks" class="rounded-4 home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                @if(Auth::check())
                @else
                    <div class="col-lg-8">
                        <div class="section-title">
                            <h3 class="title text-warning text-center">🏪 List & Manage Your Business ✨</h3>
                            <ul class="text-muted">
                                <li>Own a business and want full control over your listing? Claim and manage your business profile to keep everything accurate and up to date. 📍📞🕒</li>
                                <li>Update your business details, add photos, showcase services, and make your brand stand out to local customers searching for you. 🖼️📊📣</li>
                                <li>Log in to access your business dashboard and take charge of how your business appears in our directory - it's quick, easy, and puts your business in the spotlight. 🌟🚀</li>
                            </ul>
                        </div>
                        <div class="mt-3 text-center">
                            <a class="btn btn-warning" href="{{ route('login') }}" style="color: rgb(19, 19, 19) !important;">🔑 Login Now</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-muted">
                    <h2 class="text-warning text-center mb-4">Your Local Business Guide, All in One Place</h2>
                    <p class="text-muted text-start">
                        Finding the right local business should be simple and reliable. Our business directory brings
                        together a wide range of shops, service providers, and professionals from your city, making it
                        easier to discover options that match your needs and preferences.
                    </p>
                    <p class="text-muted text-start">
                        GujjuTicks is built to support local growth by connecting customers with businesses that matter
                        to them. Whether you are searching for everyday services or specialized professionals, our
                        platform helps you make informed choices and build meaningful local connections.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.front>
