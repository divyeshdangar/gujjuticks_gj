@props(['slug' => '', 'class' => ''])

@php
    $paths = [
        'education' => '<path d="M2 9.5L12 4l10 5.5-10 5.5L2 9.5z"/><path d="M6 12v5.5c0 .8 2.7 2.5 6 2.5s6-1.7 6-2.5V12"/><path d="M22 10v6"/>',
        'healthcare' => '<path d="M19.5 5.5a4.5 4.5 0 0 0-6.4 0L12 6.6l-1.1-1.1a4.5 4.5 0 0 0-6.4 6.4L12 19.5l7.5-7.6a4.5 4.5 0 0 0 0-6.4z"/>',
        'fintech' => '<path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
        'retail' => '<path d="M6 8h12l1 11H5L6 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
        'real-estate' => '<path d="M3 21h18"/><path d="M5 21V9l7-5 7 5v12"/><path d="M9 21v-6h6v6"/>',
        'logistics' => '<path d="M1 12h4l3 5h8l3-5h4"/><path d="M5 17a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/><path d="M15 17a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/><path d="M1 12V7h10v5"/>',
        'food-restaurants' => '<path d="M8 3v8a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2V3"/><path d="M10 13v8"/><path d="M16 3v18"/><path d="M16 8h3a2 2 0 0 1 0 4h-3"/>',
        'travel-hospitality' => '<path d="M21 16.5l-7.5-2.3L9 19l-1.5-1 3.2-4.8L3 10.5l.8-1.7L12 11l7.2-8.5L21 4v12.5z"/>',
        'on-demand' => '<path d="M13 2L4 14h7l-1 8 10-14h-7l0-6z"/>',
        'saas-b2b' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
    ];
    $inner = $paths[$slug] ?? '<circle cx="12" cy="12" r="8"/><path d="M12 8v4l2.5 2.5"/>';
@endphp

<svg class="ind-icon {{ $class }}" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $inner !!}</svg>
