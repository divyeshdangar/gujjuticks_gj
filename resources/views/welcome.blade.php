<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">

    <style>
        /* .mask1 {
            -webkit-mask-image: url(brand/full-logo-black.png);
            width: 100%;
            mask-image: url(brand/full-logo-black.png);
            mask-repeat: no-repeat;
            mask-size: 100%;

        } */
        .logo-bg {
            background-image: url('brand/dark-map-2.png');
            background-size: 200% 200%;
            animation: gradient 30s ease infinite;
            box-shadow: inset #000000 0px 0px 100px -12px;
        }
        .logo-word-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>

    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">
            <!-- Start Authentication Area -->
            <div class="m-auto mw-510 py-5">
                {{-- <div class="d-flex align-items-center gap-4 mb-3 mask1">
                    <img src="brand/map.png" alt="logo">
                </div> --}}

                <div class="mb-3">
                    <img class="logo-bg" src="brand/gujjuticks-logo-only-frame.png" alt="logo">
                    <img class="logo-word-bg" src="brand/gujjuticks-word-only-frame.png" alt="logo">
                </div>

                <div class="py-5">
                    <h2 class="h3 text-center text-danger">{{ __('dashboard.live_soon') }}</h2>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.accessible_services') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p1') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.p2') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.unbeatable_prices') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p3') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.p4') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.free_services') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p5') }}
                    <p class="mt-4">
                    </p>
                    {{ __('contact.p6') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.community_empowerment') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p7') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.p8') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.userfriendly_interface') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p9') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.p10') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.trusted_partnerships') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p11') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.p12') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.continuous_improvement') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p13') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.p14') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.privacy_and_security') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p15') }}
                    </p>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.join_community') }}</h2>

                    <p class="mt-4">
                        {{ __('contact.p16') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.p17') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.simple-layout>
