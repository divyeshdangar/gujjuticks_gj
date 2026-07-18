<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="mk-hero mk-page-hero">
        <div class="mk-wrap mk-page-hero__inner">
            <p class="mk-label">GujjuTicks</p>
            <h1 class="mk-title">{{ $dataDetail->title }}</h1>
            @if (!empty($dataDetail->meta_description))
                <p class="mk-lead">{{ $dataDetail->meta_description }}</p>
            @endif
            @if ($dataDetail->updated_at)
                <p class="mk-meta">Last updated {{ $dataDetail->updated_at->format('j F Y') }}</p>
            @endif
        </div>
    </section>

    @if (!empty($dataDetail->image) && $dataDetail->image !== 'default.png')
        <section class="mk-page-media-section">
            <div class="mk-wrap">
                <figure class="mk-page-media">
                    <img
                        src="{{ asset('images/pages/' . $dataDetail->image) }}"
                        alt="{{ $dataDetail->title }}"
                        title="{{ $dataDetail->title }}"
                        width="1200"
                        height="675"
                        loading="lazy"
                    >
                </figure>
            </div>
        </section>
    @endif

    <section class="mk-section mk-page-body">
        <div class="mk-wrap mk-page-body__inner">
            <article class="mk-cms">
                {!! $dataDetail->description !!}
            </article>
        </div>
    </section>

    <section class="mk-cta">
        <div class="mk-wrap">
            <div class="mk-cta__box">
                <p>Need a custom app, website, or software for your team?</p>
                <div class="mk-cta__actions">
                    <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                    <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
                </div>
            </div>
        </div>
    </section>

</x-layouts.site>
