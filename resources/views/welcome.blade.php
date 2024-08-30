<x-layouts.simple-layout :metaData="$metaData">
    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">
            <!-- Start Authentication Area -->
            <div class="m-auto mw-510 py-5">
                <div class="d-flex align-items-center gap-4 mb-3">
                    <h4 class="fs-3 mb-0">{{ __('contact.contact_us') }}</h4>
                    <a href="{{ route('home') }}">
                        <img src="brand/full-logo-black.png" alt="logo">
                    </a>
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