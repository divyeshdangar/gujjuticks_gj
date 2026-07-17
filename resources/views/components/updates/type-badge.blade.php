@props(['type', 'class' => ''])

@php
    $labels = [
        'status' => ['label' => 'Status', 'class' => 'bg-secondary'],
        'image' => ['label' => 'Image', 'class' => 'bg-info text-dark'],
        'youtube' => ['label' => 'Video', 'class' => 'bg-danger'],
        'poll' => ['label' => 'Poll', 'class' => 'bg-warning text-dark'],
        'qa' => ['label' => 'Q&A', 'class' => 'bg-success'],
    ];
    $config = $labels[$type] ?? ['label' => ucfirst($type), 'class' => 'bg-secondary'];
@endphp

<span {{ $attributes->merge(['class' => 'badge ' . $config['class'] . ' text-uppercase ' . $class]) }}>
    {{ $config['label'] }}
</span>
