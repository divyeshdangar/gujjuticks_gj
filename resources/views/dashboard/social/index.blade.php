<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="stats-box style-two card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon transition rounded-circle">
                                <i class="flaticon-instagram"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="body-font fw-bold fs-3 mb-2">NA</h3>
                            <a href="https://www.instagram.com/oauth/authorize?enable_fb_login=0&force_authentication=1&client_id=398693843116874&redirect_uri=https://www.gujjuticks.com/instagram/handle-login-callback&response_type=code&scope=instagram_business_basic%2Cinstagram_business_manage_messages%2Cinstagram_business_manage_comments%2Cinstagram_business_content_publish">Connect now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>