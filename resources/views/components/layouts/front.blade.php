<!doctype html>
<html lang="en">

<head>


    @php
        $metaData = $metaData ?? [];
    @endphp

    <x-common.meta :metaData="$metaData">
    </x-common.meta>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('files/images/favicon.ico') }}">

    <!-- Choise Css -->
    <link rel="stylesheet" href="{{ asset('files/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('files/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="{{ asset('files/css/icons.min.css') }}" rel="stylesheet" />
    <!-- App Css-->
    <link href="{{ asset('files/css/app.min.css') }}" id="app-style" rel="stylesheet" />
    <!--Custom Css-->

</head>

<body>

    <!-- Begin page -->
    <div>

        <!-- START TOP-BAR -->
        <div class="top-bar">
            <div class="container-fluid custom-container">
                <div class="row g-0 align-items-center">
                    <div class="col-md-7">
                        <ul class="list-inline mb-0 text-center text-md-start">
                            <li class="list-inline-item">
                                <p class="fs-13 mb-0"> <i class="mdi mdi-map-marker"></i> Your Location: <a
                                        href="javascript:void(0)" class="text-dark">New Caledonia</a></p>
                            </li>
                            <li class="list-inline-item">
                                <ul class="topbar-social-menu list-inline mb-0">
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="social-link"><i
                                                class="uil uil-whatsapp"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="social-link"><i
                                                class="uil uil-facebook-messenger-alt"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="social-link"><i
                                                class="uil uil-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="social-link"><i
                                                class="uil uil-envelope"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="social-link"><i
                                                class="uil uil-twitter-alt"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--end col-->
                    <div class="col-md-5">
                        <ul class="list-inline mb-0 text-center text-md-end">
                            <li class="list-inline-item py-2 me-2 align-middle">
                                <a href="#signupModal" class="text-dark fw-medium fs-13" data-bs-toggle="modal"><i
                                        class="uil uil-lock"></i>
                                    Sign Up</a>
                            </li>
                            <li class="list-inline-item align-middle">
                                <div class="dropdown d-inline-block language-switch">
                                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img id="header-lang-img" src="{{ asset('files/images/flags/us.jpg') }}"
                                            alt="Header Language" height="16" />
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item language"
                                            data-lang="eng">
                                            <img src="{{ asset('files/images/flags/us.jpg') }}" alt="user-image"
                                                class="me-1" height="12" />
                                            <span class="align-middle">English</span>
                                        </a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item language"
                                            data-lang="sp">
                                            <img src="{{ asset('files/images/flags/spain.jpg') }}"
                                                alt="user-image" class="me-1" height="12" />
                                            <span class="align-middle">Spanish</span>
                                        </a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item language"
                                            data-lang="gr">
                                            <img src="{{ asset('files/images/flags/germany.jpg') }}" alt="user-image"
                                                class="me-1" height="12" />
                                            <span class="align-middle">German</span>
                                        </a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item language"
                                            data-lang="it">
                                            <img src="{{ asset('files/images/flags/italy.jpg') }}" alt="user-image"
                                                class="me-1" height="12" />
                                            <span class="align-middle">Italian</span>
                                        </a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item language"
                                            data-lang="ru">
                                            <img src="{{ asset('files/images/flags/russia.jpg') }}" alt="user-image"
                                                class="me-1" height="12" />
                                            <span class="align-middle">Russian</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </div>
        <!-- END TOP-BAR -->

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg fixed-top sticky" id="navbar">
            <div class="container-fluid custom-container">
                <a class="navbar-brand text-dark fw-bold me-auto" href="{{ route('home') }}">
                    <img src="{{ asset('files/images/logo-dark.png') }}" height="45" alt=""
                        class="logo-dark" />
                    <img src="{{ asset('files/images/logo-light.png') }}" height="45" alt=""
                        class="logo-light" />
                </a>
                <div>
                    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
                        aria-label="Toggle navigation">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto navbar-center">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pages.blog.list') }}" class="nav-link">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form.contact') }}" class="nav-link">Contact</a>
                        </li>
                    </ul><!--end navbar-nav-->
                </div>
                <!--end navabar-collapse-->
                <ul class="header-menu list-inline d-flex align-items-center mb-0">
                    <li class="list-inline-item dropdown me-4">
                        <a href="javascript:void(0)" class="header-item noti-icon position-relative"
                            id="notification" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-bell fs-22"></i>
                            <div class="count position-absolute">3</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end p-0"
                            aria-labelledby="notification">
                            <div class="notification-header border-bottom bg-light">
                                <h6 class="mb-1"> Notification </h6>
                                <p class="text-muted fs-13 mb-0">You have 4 unread Notification</p>
                            </div>
                            <div class="notification-wrapper dropdown-scroll">
                                <a href="javascript:void(0)" class="text-dark notification-item d-block active">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs bg-primary text-white rounded-circle text-center">
                                                <i class="uil uil-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">22 verified registrations</h6>
                                            <p class="mb-0 fs-12 text-muted"><i class="mdi mdi-clock-outline"></i>
                                                <span>3 min
                                                    ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a><!--end notification-item-->
                                <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ asset('files/images/user/img-02.jpg') }}" class="rounded-circle avatar-xs"
                                                alt="user-pic">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">James Lemire</h6>
                                            <p class="text-muted fs-12 mb-0"><i class="mdi mdi-clock-outline"></i>
                                                <span>15 min
                                                    ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a><!--end notification-item-->
                                <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ asset('files/images/featured-job/img-04.png') }}"
                                                class="rounded-circle avatar-xs" alt="user-pic">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">Applications has been approved</h6>
                                            <p class="text-muted mb-0 fs-12"><i class="mdi mdi-clock-outline"></i>
                                                <span>45 min
                                                    ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a><!--end notification-item-->
                                <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ asset('files/images/user/img-01.jpg') }}" class="rounded-circle avatar-xs"
                                                alt="user-pic">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">Kevin Stewart</h6>
                                            <p class="text-muted mb-0 fs-12"><i class="mdi mdi-clock-outline"></i>
                                                <span>1 hour
                                                    ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a><!--end notification-item-->
                                <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ asset('files/images/featured-job/img-01.png') }}"
                                                class="rounded-circle avatar-xs" alt="user-pic">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-15">Creative Agency</h6>
                                            <p class="text-muted mb-0 fs-12"><i class="mdi mdi-clock-outline"></i>
                                                <span>2 hour
                                                    ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a><!--end notification-item-->
                            </div><!--end notification-wrapper-->
                            <div class="notification-footer border-top text-center">
                                <a class="primary-link fs-13" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item dropdown">
                        <a href="javascript:void(0)" class="header-item" id="userdropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('files/images/profile.jpg') }}" alt="mdo" width="35" height="35" class="rounded-circle me-1">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
                            <li><a class="dropdown-item" href="manage-jobs.html">Manage Jobs</a></li>
                            <li><a class="dropdown-item" href="bookmark-jobs.html">Bookmarks Jobs</a></li>
                            <li><a class="dropdown-item" href="profile.html">My Profile</a></li>
                            <li><a class="dropdown-item" href="sign-out.html">Logout</a></li>
                        </ul>
                    </li>
                </ul><!--end header-menu-->
            </div>
            <!--end container-->
        </nav>
        <!-- Navbar End -->


        <div class="main-content">

            <div class="page-content">

                {{ $slot }}

            </div>
            <!-- End Page-content -->

            <!-- START SUBSCRIBE -->
            <section class="bg-subscribe">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="text-center text-lg-start">
                                <h4 class="text-white">Get New Jobs Notification!</h4>
                                <p class="text-white-50 mb-0">Subscribe & get all related jobs notification.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0">
                                <form class="subscribe-form" action="#">
                                    <div class="input-group justify-content-center justify-content-lg-end">
                                        <input type="text" class="form-control" id="subscribe"
                                            placeholder="Enter your email">
                                        <button class="btn btn-primary" type="button"
                                            id="subscribebtn">Subscribe</button>
                                    </div>
                                </form><!--end form-->
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
                <div class="email-img d-none d-lg-block">
                    <img src="{{ asset('files/images/subscribe.png') }}" alt="" class="img-fluid">
                </div>
            </section>
            <!-- END SUBSCRIBE -->

            <!-- START FOOTER-ALT -->
            <div class="footer-alt">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-white-50 text-center mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> &copy; GujjuTicks - First of it's kind
                                Gujarati Portal.
                            </p>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </div>
            <!-- END FOOTER -->

            <!--start back-to-top-->
            <button onclick="topFunction()" id="back-to-top">
                <i class="mdi mdi-arrow-up"></i>
            </button>
            <!--end back-to-top-->
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('files/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>


    <!-- Choice Js -->
    <script src="{{ asset('files/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Switcher Js -->
    <script src="{{ asset('files/js/pages/switcher.init.js') }}"></script>


    <script src="{{ asset('files/js/app.js') }}"></script>

</body>

</html>
