<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="assets/css/remixicon.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="assets/css/simplebar.css">
    <link rel="stylesheet" href="assets/css/apexcharts.css">
    <link rel="stylesheet" href="assets/css/prism.css">
    <link rel="stylesheet" href="assets/css/rangeslider.css">
    <link rel="stylesheet" href="assets/css/sweetalert.min.css">
    <link rel="stylesheet" href="assets/css/quill.snow.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <?php
        $metaData = [
            "title" => "",
            "description" => "",
            "image" => "",
            "url" => "",
        ];
    ?>

    <x-common.meta :metaData="$metaData">
    </x-common.meta>

</head>

<body>
    <!-- Start Preloader Area -->
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
    <!-- End Preloader Area -->

    <!-- Start Sidebar Area -->
    <div class="sidebar-area" id="sidebar-area">
        <div class="logo position-relative">
            <a href="index.html" class="d-block text-decoration-none">
                <img src="assets/images/logo-icon.png" alt="logo-icon">
                <span class="logo-text fw-bold text-dark">GujjuTicks</span>
            </a>
            <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
                <i data-feather="x"></i>
            </button>
        </div>

        <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
            <ul class="menu-inner">
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i data-feather="grid" class="menu-icon tf-icons"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
            </ul>
        </aside>

        <div class="bg-white z-1 admin">
            <div class="d-flex align-items-center admin-info border-top">
                <div class="flex-shrink-0">
                    <a href="profile.html" class="d-block">
                        <img src="{{ auth()->user()->profile }}" class="rounded-circle wh-54" alt="admin">
                    </a>
                </div>
                <div class="flex-grow-1 ms-3 info">
                    <a href="profile.html" class="d-block name">{{ auth()->user()->name }}</a>
                    <a href="{{ route('logout') }}">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sidebar Area -->

    <!-- Start Main Content Area -->
    <div class="container-fluid">
        <div class="main-content d-flex flex-column">

            <!-- Start Header Area -->
            <header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-6 col-md-4">
                        <div class="left-header-content">
                            <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                                <li>
                                    <button class="header-burger-menu bg-transparent p-0 border-0" id="header-burger-menu">
                                        <i data-feather="menu"></i>
                                    </button>
                                </li>
                                <li>
                                    <form class="src-form position-relative">
                                        <input type="text" class="form-control" placeholder="Search here..">
                                        <button type="submit" class="src-btn position-absolute top-50 end-0 translate-middle-y bg-transparent p-0 border-0">
                                            <i data-feather="search"></i>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-8 col-sm-6 col-md-8">
                        <div class="right-header-content mt-2 mt-sm-0">
                            <ul class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                                <li class="header-right-item">
                                    <div class="dropdown notifications language">
                                        <button class="btn btn-secondary border-0 p-0 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="assets/images/india.png" class="rounded-circle wh-22" alt="English">
                                        </button>
                                        <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                            <div class="notification-menu">
                                                <a href="notification.html" class="dropdown-item p-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/india.png" class="wh-22 rounded-circle" alt="English">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h4>English</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="notification-menu">
                                                <a href="notification.html" class="dropdown-item p-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/india.png" class="wh-22 rounded-circle" alt="हिंदी">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h4>हिंदी</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="notification-menu mb-0">
                                                <a href="notification.html" class="dropdown-item p-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/india.png" class="wh-22 rounded-circle" alt="ગુજરાતી">
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
                                <li class="header-right-item">
                                    <div class="dropdown notifications email">
                                        <button class="btn btn-secondary border-0 p-0 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i data-feather="mail"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                            <h5 class="m-0 p-0 fw-bold d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                                                <span>Message </span>
                                                <button class="p-0 m-0 bg-transparent border-0">Clear All</button>
                                            </h5>

                                            <div class="notification-menu">
                                                <a href="notification.html" class="dropdown-item p-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/pdf.svg" alt="pdf">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h4>Help/Support Desk</h4>
                                                            <span>11:47 PM Wednesday</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <a href="notification.html" class="dropdown-item text-center text-primary d-block view-all pt-3 pb-0 fw-semibold">
                                                View All
                                                <i data-feather="chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="header-right-item">
                                    <div class="dropdown notifications noti">
                                        <button class="btn btn-secondary border-0 p-0 position-relative badge" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i data-feather="bell"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-lg p-0 border-0 p-4">
                                            <h5 class="m-0 p-0 fw-bold d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                                                <span>Notifications </span>
                                                <button class="p-0 m-0 bg-transparent border-0">Clear All</button>
                                            </h5>

                                            <div class="notification-menu mb-0">
                                                <a href="notification.html" class="dropdown-item p-0">
                                                    <h4>Create a new project for client</h4>

                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/notifications-1.jpg" alt="notifications">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <p>Allow users to like products in your WooCommerce</p>
                                                        </div>
                                                    </div>
                                                    <span>April, 18</span>
                                                </a>
                                            </div>

                                            <a href="notification.html" class="dropdown-item text-center text-primary d-block view-all pt-3 pb-0 fw-semibold">
                                                View All
                                                <i data-feather="chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="header-right-item d-none d-md-block">
                                    <div class="today-date">
                                        <span id="digitalDate"></span>
                                        <i data-feather="calendar"></i>
                                    </div>
                                </li>
                                <li class="header-right-item">
                                    <div class="dropdown admin-profile">
                                        <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor" data-bs-toggle="dropdown">
                                            <div class="flex-shrink-0">
                                                <img class="rounded-circle wh-54" src="{{ auth()->user()->profile }}" alt="admin">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-none d-xxl-block">
                                                        <span class="degeneration">GT USER</span>
                                                        <div class="d-flex align-content-center">
                                                            <h3>{{ auth()->user()->name }}</h3>
                                                            <div class="down">
                                                                <i data-feather="chevron-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ul class="dropdown-menu border-0 bg-white w-100 admin-link">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body" href="profile.html">
                                                    <i data-feather="user"></i>
                                                    <span class="ms-2">Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body" href="account.html">
                                                    <i data-feather="settings"></i>
                                                    <span class="ms-2">Setting</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body" href="{{ route('logout') }}">
                                                    <i data-feather="log-out"></i>
                                                    <span class="ms-2">Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header Area -->

            <!-- Start Body Content Area -->



            {{ $slot }}




            <!-- End Body Content Area -->

            <div class="flex-grow-1"></div>

            <!-- Start Footer Area -->
            <footer class="footer-area bg-white text-center rounded-top-10">
                <p class="fs-14">© <span class="text-primary">GujjuTicks</span> - Made in <a href="" target="_blank" class="text-decoration-none">Gujarat</a></p>
            </footer>
            <!-- End Footer Area -->
        </div>
    </div>
    <!-- Start Main Content Area -->

    <!-- Start Theme Setting Area -->
    <!-- End Theme Setting Area -->

    <!-- Link Of JS File -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/dragdrop.js"></script>
    <script src="assets/js/rangeslider.min.js"></script>
    <script src="assets/js/sweetalert.js"></script>
    <script src="assets/js/quill.min.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/js/prism.js"></script>
    <script src="assets/js/clipboard.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/simplebar.min.js"></script>
    <script src="assets/js/apexcharts.min.js"></script>
    <script src="assets/js/amcharts.js"></script>
    <script src="assets/js/custom/ecommerce-chart.js"></script>
    <script src="assets/js/custom/custom.js"></script>
</body>

</html>