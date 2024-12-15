<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <style>
        :root {
            --white: #fff;
            --main: #eaedf0;
            --accent: #757FEF;
            --accent-2: #ebedf0;
        }

        .h {
            margin: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .header-display {
            display: flex;
            align-items: center;
        }

        .header-display p {
            color: var(--accent);
            margin: 5px;
            font-size: 1.2rem;
            word-spacing: 0.5rem;
        }

        pre {
            padding: 10px;
            margin: 0;
            cursor: pointer;
            font-size: 1.2rem;
            color: var(--accent);
        }

        .days,
        .week {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            margin: auto;
            padding: 0 20px;
            justify-content: space-between;
        }

        .week div,
        .days div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 3rem;
            width: 3em;
            border-radius: 8px;
        }

        .days div:hover {
            background: var(--accent-2);
            color: rgb(25, 25, 201);
            cursor: pointer;
        }

        .week div {
            opacity: 0.5;
        }

        .c_badge {
            position: absolute;
            background: #d63384;
            color: rgba(0,0,0,0);
            max-height: 4px;
            max-width: 4px;
            border-radius: 100%;
            margin-left: 30px;
            margin-top: -30px;
        }

        .current-date {
            background-color: var(--accent);
            color: var(--white);
        }

        .each-date {
            background-color: var(--accent);
            color: var(--white);
        }

        .display-selected {
            margin-bottom: 10px;
            padding: 20px 20px;
            text-align: center;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.connected_accounts') }}</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item"
                                        href="https://www.instagram.com/oauth/authorize?enable_fb_login=0&force_authentication=1&client_id=1141273137620884&redirect_uri=https://www.gujjuticks.com/instagram/handle-login-callback&response_type=code&scope=instagram_business_basic%2Cinstagram_business_manage_messages%2Cinstagram_business_manage_comments%2Cinstagram_business_content_publish">
                                        <i data-feather="instagram"></i>
                                        {{ __('dashboard.add') }} {{ __('dashboard.instagram') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-4">
                        @foreach ($dataList as $item)
                            <div class="stats-box style-two card border-0 rounded-10 mb-4">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-shrink-0">
                                            <img style="max-height: 58px;" class="rounded" src="{{ $item->profile_pic }}">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h3 class="body-font fw-bold fs-4 mb-2">{{ $item->name }}</h3>
                                            <a class="text-decoration-none" href=""><i class="flaticon-instagram mt-5"></i> {{ $item->username }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.calender_and_posts') }}</h4>
                    </div>
                    <div class="mb-4">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.dashboard>
