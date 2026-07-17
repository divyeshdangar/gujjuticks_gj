<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap">
    </noscript>

    <x-site.meta :metaData="$metaData" />

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('files/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/site/base.css') }}">
    @if ($page)
        <link rel="stylesheet" href="{{ asset('css/site/' . $page . '.css') }}">
    @endif

    @production
        <meta name="p:domain_verify" content="66da8104105f0a877307b47e093de2ef" />
    @endproduction
</head>

<body class="site-body{{ $page ? ' site-body--' . $page : '' }}">
    <a class="site-skip" href="#site-main">Skip to content</a>

    <x-site.header />

    <main id="site-main" class="site-main">
        {{ $slot }}
    </main>

    <x-site.footer />

    <script src="{{ asset('js/site/site.js') }}" defer></script>

    @if (session('message'))
        <script>
            (function() {
                try {
                    var message = @json(session('message'));
                    if (message && message.title) {
                        alert(message.title + (message.description ? '\n' + message.description : ''));
                    }
                } catch (e) {}
            })();
        </script>
    @endif
</body>

</html>
