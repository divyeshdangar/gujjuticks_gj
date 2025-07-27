<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @php
        $metaData = $metaData ?? [];
    @endphp

    <x-common.meta :metaData="$metaData">
    </x-common.meta>

    <link rel="shortcut icon" href="{{ asset('files/images/favicon.ico') }}">
    {{-- <link rel="preload" as="image" href="{{ asset('home/img-01.png') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('files/libs/choices.js/public/assets/styles/choices.min.css') }}"> --}}
    <link href="{{ asset('files/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" />
    {{-- <link href="{{ asset('files/css/icons.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('files/css/app.min.css') }}" id="app-style" rel="stylesheet" />
</head>

<body data-bs-theme="dark">

    <nav class="navbar navbar-expand-lg fixed-top sticky mt-0" id="navbar">
        <div class="container-fluid custom-container">
            <a title="GujjuTicks Logo" class="navbar-brand text-dark fw-bold me-auto" href="{{ route('home') }}">
                {{-- <img src="{{ asset('files/images/logo-dark.png') }}" height="45" alt="" class="logo-dark" /> --}}
                <img src="{{ asset('files/images/logo-light.png') }}" width="1000" height="220" alt=""
                    class="logo-light" style="height: 30px; width: 136px;" />
            </a>
            <div>
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#gtMenu"
                    aria-controls="gtMenu" aria-label="GujjuTicks Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="p-2" width="35" height="35" fill="#fff"
                        viewBox="0 0 448 512">
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="gtMenu">
                <ul class="navbar-nav mx-auto navbar-center">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    @if (false)
                        <li class="nav-item">
                            <a href="{{ route('pages.news.list') }}" class="nav-link">News</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pages.card.list') }}" class="nav-link link-info shake-text">Cards 🎴</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('pages.blog.list') }}" class="nav-link">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pages.cities.list') }}" class="nav-link">Cities</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pages.resume.list') }}" class="nav-link">Resume Builder</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('form.contact') }}" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
            <ul class="header-menu list-inline d-flex align-items-center mb-0">
                @if (auth()->user())
                    <li class="list-inline-item dropdown">
                        <a href="javascript:void(0)" class="header-item" id="userdropdown" data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->profile() }}" alt="{{ auth()->user()->name }}" width="35"
                                height="35" class="rounded-circle me-1">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="list-inline-item dropdown">
                        <a href="{{ route('login') }}" class="header-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bg-warning"
                                style="padding:5px; border-radius:10%" width="35" height="35" fill="#4a4a37"
                                viewBox="0 0 448 512">
                                <path
                                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                            </svg>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <div class="page-content">
            {{ $slot }}
        </div>
        <section class="bg-subscribe">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <div class="text-center text-lg-start">
                            <span class="text-white h4">Get New Notification!</span>
                            <p class="text-white-50 mb-0">Subscribe & get all related notification.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-4 mt-lg-0">
                            <form class="subscribe-form" action="#">
                                <div class="input-group justify-content-center justify-content-lg-end">
                                    <input type="text" class="form-control" id="subscribe"
                                        placeholder="Enter your email">
                                    <button class="btn btn-dark" type="button" id="subscribebtn">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="email-img d-none d-lg-block">
                <img src="{{ asset('files/images/subscribe.png') }}" alt="" class="img-fluid">
            </div>
        </section>

        <div class="footer-alt">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-white-50 text-center mb-0">
                            <?php echo Date('Y'); ?> GujjuTicks - First of it's kind
                            Gujarati Portal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('files/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script> --}}
    {{-- <script src="{{ asset('files/js/app.js') }}"></script> --}}

    <?php 
        if(session('message')){ ?>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script>
        var message = JSON.parse('<?php echo json_encode(session('message')); ?>');
        if (message) {
            Swal.fire(message.title, message.description, message.type);
        }

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),
            tooltipList = tooltipTriggerList.map(function(t) {
                return new bootstrap.Tooltip(t)
            });
    </script>
    <?php }
    ?>
</body>

</html>
