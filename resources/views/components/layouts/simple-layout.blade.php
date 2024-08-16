<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @production
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-CB42ST9162"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-CB42ST9162');
        </script>    
    @endproduction

    @php
        $metaData = $metaData ?? [];
    @endphp

    <x-common.meta :metaData="$metaData">
    </x-common.meta>
</head>

<body>
    
    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span class="d-inline-block">G</span>
                <span class="d-inline-block">u</span>
                <span class="d-inline-block">j</span>
                <span class="d-inline-block">j</span>
                <span class="d-inline-block">u</span>
                <span class="d-inline-block">T</span>
                <span class="d-inline-block">i</span>
                <span class="d-inline-block">c</span>
                <span class="d-inline-block">k</span>
                <span class="d-inline-block">s</span>
            </div>
        </div>
    </div>

    <!-- Start Main Content Area -->
    <div class="container-fluid">
        <div class="d-flex flex-column">

            @if($showHeader)
                <header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-sm-6 col-md-4">
                            <div class="left-header-content">
                                <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                                    <li>
                                        <a href="{{ route('home') }}" class="d-block text-decoration-none">
                                            <img src="{{ asset('brand/full-logo-black.png') }}" style="max-height: 50px;" alt="logo-icon">                                        
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-8 col-sm-6 col-md-8">
                            <div class="right-header-content mt-2 mt-sm-0">
                                <ul class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                                    <li class="header-right-item">
                                        <div class="dropdown notifications email">
                                            <a class="btn btn-secondary border-0 p-0 position-relative" href="{{ route('pages.blog.list') }}" title="Blog">
                                                <i data-feather="file-text"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="header-right-item">
                                        <div class="dropdown notifications language">
                                            <button class="btn btn-secondary border-0 p-0 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/images/india.png') }}" class="rounded-circle wh-22" alt="English">
                                            </button>
                                            <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                                <div class="notification-menu">
                                                    <a href="{{ route('language', ['locale' => 'en']) }}" class="dropdown-item p-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('assets/images/india.png') }}" class="wh-22 rounded-circle" alt="English">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h4>English</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="notification-menu">
                                                    <a href="{{ route('language', ['locale' => 'hi']) }}" class="dropdown-item p-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('assets/images/india.png') }}" class="wh-22 rounded-circle" alt="हिंदी">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h4>हिंदी</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="notification-menu mb-0">
                                                    <a href="{{ route('language', ['locale' => 'gj']) }}" class="dropdown-item p-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('assets/images/india.png') }}" class="wh-22 rounded-circle" alt="ગુજરાતી">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h4>ગુજરાતી</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>
            @endif

            {{ $slot }}

            <div class="flex-grow-1"></div>
            <footer class="footer-area bg-white text-center rounded-top-10">
                <p class="fs-14">© <span class="text-primary">{{ __('dashboard.gujjuticks') }}</span> - {{ __('dashboard.made_in') }}</p>
            </footer>
        </div>
    </div>
                
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/simple-custom.js') }}"></script>

    <script>
        <?php 
            if(session('message')){ ?>
                var message = JSON.parse('<?php echo json_encode(session('message')) ?>');
            <?php }
        ?>
    </script>
</body>

</html>