<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    {{-- <link rel="stylesheet" href="assets/css/remixicon.css"> --}}
    {{-- <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="assets/css/simplebar.css">
    <link rel="stylesheet" href="assets/css/apexcharts.css">
    <link rel="stylesheet" href="assets/css/prism.css">
    <link rel="stylesheet" href="assets/css/rangeslider.css">
    <link rel="stylesheet" href="assets/css/sweetalert.min.css">
    <link rel="stylesheet" href="assets/css/quill.snow.css"> --}}
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

    <!-- Start Main Content Area -->


    {{ $slot }}


    <!-- Start Theme Setting Area -->
    <!-- End Theme Setting Area -->

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom/simple-custom.js"></script>
</body>

</html>