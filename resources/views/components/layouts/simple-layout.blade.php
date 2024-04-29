<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <?php    
    $metaData = $metaData ?? [];
    ?>
    <x-common.meta :metaData="$metaData">
    </x-common.meta>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TWRDGF8');</script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TWRDGF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

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
                <a class="mx-2 link-primary text-decoration-none" href="{{ route('home') }}">Home</a>
                <a class="mx-2 link-primary text-decoration-none" href="{{ route('form.contact') }}">Contact Us</a>
                {{-- <a class="mx-2 link-primary text-decoration-none" href="">Privacy Policy</a>
                <a class="mx-2 link-primary text-decoration-none" href="">Terms</a> --}}
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