<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom/simple-custom.js"></script>
</body>

</html>