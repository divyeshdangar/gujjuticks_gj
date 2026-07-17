@php
    $title = $metaData['title'] ?? 'GujjuTicks — Software, Tech & AI Products';
    $description = $metaData['description'] ?? 'GujjuTicks builds software, tech products, and AI tools for modern businesses.';
    $url = $metaData['url'] ?? url('/');
    $image = $metaData['image'] ?? asset('brand/full-logo-black.png');
    $siteName = 'GujjuTicks';
    $type = $metaData['og_type'] ?? 'website';
    $robots = $metaData['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="author" content="GujjuTicks">
<meta name="robots" content="{{ $robots }}">
@if (!empty($metaData['keywords']))
    <meta name="keywords" content="{{ $metaData['keywords'] }}">
@endif
<link rel="canonical" href="{{ $url }}">
@if (!empty($metaData['prev']))
    <link rel="prev" href="{{ $metaData['prev'] }}">
@endif
@if (!empty($metaData['next']))
    <link rel="next" href="{{ $metaData['next'] }}">
@endif

<meta property="og:locale" content="{{ $metaData['locale'] ?? 'en_US' }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="{{ $metaData['image_alt'] ?? $title }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@gujjuticks">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

@if (!empty($metaData['schema']))
    <script type="application/ld+json">
        {!! json_encode($metaData['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endif
