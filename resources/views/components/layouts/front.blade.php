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
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto navbar-center">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pages.cities.list') }}" class="nav-link">Cities</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pages.blog.list') }}" class="nav-link">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('form.contact') }}" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
            <ul class="header-menu list-inline d-flex align-items-center mb-0">
                <li class="list-inline-item dropdown">
                    <a class="header-item" id="userdropdown">
                        <img src="{{ asset('files/images/profile.jpg') }}" alt="mdo" width="35" height="35"
                            class="rounded-circle me-1">
                    </a>
                </li>
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
