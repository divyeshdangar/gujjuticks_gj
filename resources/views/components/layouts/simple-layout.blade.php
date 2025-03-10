<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @production
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-CB42ST9162"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
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

<body sidebar-data-theme="sidebar-show">
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

            @if (isset($showHeader))
                <header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-sm-6 col-md-4">
                            <div class="left-header-content">
                                <ul
                                    class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                                    <li>
                                        <a href="{{ route('home') }}" class="d-block text-decoration-none">
                                            <img style="max-height:45px" src="{{ asset('brand/full-logo-black.png') }}"
                                                alt="logo-icon">
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <form class="src-form position-relative">
                                            <input type="text" name="search" class="form-control" placeholder="{{ __('dashboard.search_here') }}">
                                            <button type="submit" class="src-btn position-absolute top-50 end-0 translate-middle-y bg-transparent p-0 border-0">
                                                <i data-feather="search"></i>
                                            </button>
                                        </form>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-8 col-sm-6 col-md-8">
                            <div class="right-header-content mt-2 mt-sm-0">
                                <ul
                                    class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                                    <li class="header-right-item">
                                        <div class="dropdown notifications email">
                                            <a class="btn btn-secondary border-0 p-0 position-relative"
                                                href="{{ route('form.contact') }}" title="Contact">
                                                <i data-feather="mail"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="header-right-item">
                                        <div class="dropdown notifications email">
                                            <a class="btn btn-secondary border-0 p-0 position-relative"
                                                href="{{ route('pages.blog.list') }}" title="Blog">
                                                <i data-feather="file-text"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="header-right-item">
                                        <div class="dropdown notifications language">
                                            <button class="btn btn-secondary border-0 p-0 position-relative"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/images/india.png') }}"
                                                    class="rounded-circle wh-22" alt="English">
                                            </button>
                                            <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                                <div class="notification-menu">
                                                    <a href="{{ route('language', ['locale' => 'en']) }}"
                                                        class="dropdown-item p-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('assets/images/india.png') }}"
                                                                    class="wh-22 rounded-circle" alt="English">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h4>English</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="notification-menu">
                                                    <a href="{{ route('language', ['locale' => 'hi']) }}"
                                                        class="dropdown-item p-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('assets/images/india.png') }}"
                                                                    class="wh-22 rounded-circle" alt="हिंदी">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h4>हिंदी</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="notification-menu mb-0">
                                                    <a href="{{ route('language', ['locale' => 'gj']) }}"
                                                        class="dropdown-item p-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('assets/images/india.png') }}"
                                                                    class="wh-22 rounded-circle" alt="ગુજરાતી">
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
                                    @if (\Auth::user())
                                        <li class="header-right-item">
                                            <div class="dropdown admin-profile">
                                                <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor"
                                                    data-bs-toggle="dropdown">
                                                    <div class="flex-shrink-0">
                                                        <img class="rounded-circle wh-54"
                                                            src="{{ auth()->user()->profile() }}" alt="admin">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="d-none d-xxl-block">
                                                                <span
                                                                    class="degeneration">{{ __('dashboard.user') }}</span>
                                                                <div class="d-flex align-content-center">
                                                                    @php
                                                                        $name = strlen(auth()->user()->name) > 10 ? substr(auth()->user()->name,0,10)."..." : auth()->user()->name;
                                                                    @endphp
                                                                    <h3>{{ $name }}</h3>
                                                                    <div class="down">
                                                                        <i data-feather="chevron-down"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <ul class="dropdown-menu border-0 bg-white w-100 admin-link">
                                                    <li class="d-none">
                                                        <a class="dropdown-item d-flex align-items-center text-body"
                                                            href="{{ route('dashboard.profile.edit') }}">
                                                            <i data-feather="user"></i>
                                                            <span class="ms-2">{{ __('dashboard.profile') }}</span>
                                                        </a>
                                                    </li>
                                                    {{-- @if(auth()->user()->is_admin()) --}}
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center text-body"
                                                                href="{{ route('dashboard') }}">
                                                                <i data-feather="grid"></i>
                                                                <span class="ms-2">{{ __('dashboard.dashboard') }}</span>
                                                            </a>
                                                        </li>                                                        
                                                    {{-- @endif --}}
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-body"
                                                            href="{{ route('logout') }}">
                                                            <i data-feather="log-out"></i>
                                                            <span class="ms-2">{{ __('dashboard.logout') }}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @else
                                        <li class="header-right-item">
                                            <div class="dropdown notifications email">
                                                <a class="btn btn-secondary border-0 p-0 position-relative"
                                                    href="{{ route('login') }}" title="Blog">
                                                    <i data-feather="user"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>
            @endif

            {{ $slot }}

            <div class="flex-grow-1"></div>
            <footer class="footer-area bg-white text-center rounded-top-10">
                <p class="fs-14">© <span class="text-primary">{{ __('dashboard.gujjuticks') }}</span> -
                    {{ __('dashboard.made_in') }}</p>
            </footer>
        </div>
    </div>

    {{-- <button class="btn btn-danger theme-settings-btn p-0 position-fixed z-2 text-center" data-bs-toggle="modal" data-bs-target="#exampleModal4" style="bottom: 30px; right: 30px; width: 40px; height: 40px;" type="button">
        <i data-feather="grid" class="wh-20 text-white position-relative" style="top: -1px; outline: none;" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Click for Menu"></i>
    </button> --}}

    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">GujjuTicks Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="" class="btn btn-outline-dark w-100 fw-semibold py-2 px-4 mt-2 me-2 hover-white">
                        Contact
                    </a>
                    <a href="" class="btn btn-outline-dark w-100 fw-semibold py-2 px-4 mt-2 me-2 hover-white">
                        Blogs
                    </a>
                    <a href="" class="btn btn-outline-dark w-100 fw-semibold py-2 px-4 mt-2 me-2 hover-white">
                        Gujarat
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>    
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/simple-custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

    <script>
        <?php 
            if(session('message')){ ?>
        var message = JSON.parse('<?php echo json_encode(session('message')); ?>');
        <?php }
        ?>
    </script>
</body>

</html>
