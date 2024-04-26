<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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

    {{ $slot }}


    <!-- Start Footer Area -->
    <footer class="footer-area bg-white text-center rounded-top-10">

        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-3">
                <a class="mx-2 link-primary text-decoration-none" href="">Home</a>
                <a class="mx-2 link-primary text-decoration-none" href="">Contact Us</a>
                <a class="mx-2 link-primary text-decoration-none" href="">Privacy Policy</a>
                <a class="mx-2 link-primary text-decoration-none" href="">Terms</a>
            </div>
        </div>
        
        <p class="fs-14">© <span class="text-primary">{{ __('dashboard.gujjuticks') }}</span> - {{ __('dashboard.made_in') }}</p>
    </footer>
    <!-- End Footer Area -->

                
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
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