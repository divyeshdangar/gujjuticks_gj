<x-layouts.dashboard-layout :showHeader="true" :metaData="$metaData">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-12 col-lg-5">
            <div class="welcome-farol card bg-primary border-0 rounded-10 position-relative mb-4">
                <div class="card-body p-4 my-2">
                    <div class="mw-350">
                        <h3 class="text-white fw-semibold fs-20 mb-2">{{ __('dashboard.welcome') }}</h3>
                        <p class="text-white fs-15">{{ __('dashboard.welcome_desc') }}</p>
                    </div>
                </div>
                <img src="{{ asset('assets/images/welcome-shape.png') }}" class="position-absolute bottom-0 end-0" style="right: 10px !important; bottom: 10px !important;" alt="welcome-shape">
            </div>
        </div>
    </div>
</x-layouts.dashboard-layout>