<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="mk-hero">
        <div class="mk-wrap mk-hero__inner">
            <p class="mk-label">{{ $hub['label'] }}</p>
            <h1 class="mk-title">{{ $hub['heading'] }}</h1>
            <p class="mk-lead">{{ $hub['lead'] }}</p>
        </div>
    </section>

    <section class="mk-section" aria-label="{{ $hub['label'] }}">
        <div class="mk-wrap">
            <div class="mk-grid">
                @foreach ($items as $item)
                    <a href="{{ route($itemRoute, ['slug' => $item['slug']]) }}" class="mk-card">
                        @if (!empty($item['tag']))
                            <p class="mk-card__tag">{{ $item['tag'] }}</p>
                        @endif
                        <h2 class="mk-card__title">{{ $item['title'] }}</h2>
                        <p class="mk-card__summary">{{ $item['summary'] }}</p>
                        <span class="mk-card__more">Learn more</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <p>Ready to talk through a project?</p>
            <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
        </div>
    </section>

</x-layouts.site>
