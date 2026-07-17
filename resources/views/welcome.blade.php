<x-layouts.site :metaData="$metaData" page="home">

    <section class="hm-hero">
        <div class="hm-hero__copy">
            <p class="hm-hero__label">Startup · Custom software</p>
            <p class="hm-hero__brand">GujjuTicks</p>
            <h1 class="hm-hero__title">Custom apps, websites, and software — built for growing teams.</h1>
            <p class="hm-hero__lead">
                GujjuTicks is a software startup that designs and develops custom applications, modern websites,
                and business software so you can launch faster and operate with confidence.
            </p>
            <div class="hm-hero__actions">
                <a class="hm-btn hm-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="hm-btn hm-btn--ghost" href="#services">Our services</a>
            </div>
        </div>
        <div class="hm-hero__visual" aria-hidden="true">
            <img src="{{ asset('brand/pages/gujjuticks-homepage.png') }}" alt="" width="1600" height="900"
                loading="eager" decoding="async">
        </div>
    </section>

    <section class="hm-section" id="services" aria-labelledby="services-heading">
        <div class="hm-wrap">
            <div class="hm-section__head">
                <h2 id="services-heading">What we provide</h2>
                <p>
                    End-to-end delivery for startups and businesses that need a dependable build partner —
                    from first version to ongoing improvements.
                </p>
            </div>
            <div class="hm-build">
                <article class="hm-build__item">
                    <h3>Custom apps</h3>
                    <p>
                        Mobile and web applications tailored to your workflows — dashboards, customer portals,
                        internal tools, and product MVPs ready for real users.
                    </p>
                </article>
                <article class="hm-build__item">
                    <h3>Websites</h3>
                    <p>
                        Fast, clear marketing and product websites that present your brand well, convert visitors,
                        and stay easy to update as you grow.
                    </p>
                </article>
                <article class="hm-build__item">
                    <h3>Custom software</h3>
                    <p>
                        Business systems and integrations that automate operations, connect your tools,
                        and reduce manual work across teams.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="hm-section hm-section--alt" id="how-we-work" aria-labelledby="process-heading">
        <div class="hm-wrap">
            <div class="hm-section__head">
                <h2 id="process-heading">How we work</h2>
                <p>A simple process so you always know what happens next.</p>
            </div>
            <ol class="hm-steps">
                <li class="hm-steps__item">
                    <span class="hm-steps__num" aria-hidden="true">01</span>
                    <div>
                        <h3>Discover</h3>
                        <p>We clarify goals, users, timeline, and constraints in a short kickoff.</p>
                    </div>
                </li>
                <li class="hm-steps__item">
                    <span class="hm-steps__num" aria-hidden="true">02</span>
                    <div>
                        <h3>Design &amp; plan</h3>
                        <p>You get a clear scope, milestones, and UI direction before heavy build work starts.</p>
                    </div>
                </li>
                <li class="hm-steps__item">
                    <span class="hm-steps__num" aria-hidden="true">03</span>
                    <div>
                        <h3>Build &amp; launch</h3>
                        <p>We ship in iterations, test with you, and go live with a stable release.</p>
                    </div>
                </li>
                <li class="hm-steps__item">
                    <span class="hm-steps__num" aria-hidden="true">04</span>
                    <div>
                        <h3>Support &amp; grow</h3>
                        <p>After launch we can maintain, improve, and add features as your needs evolve.</p>
                    </div>
                </li>
            </ol>
        </div>
    </section>

    <section class="hm-section" id="who-we-help" aria-labelledby="help-heading">
        <div class="hm-wrap">
            <div class="hm-section__head">
                <h2 id="help-heading">Who we help</h2>
                <p>Founders and operators who need a capable software partner without a full in-house team.</p>
            </div>
            <div class="hm-build">
                <article class="hm-build__item">
                    <h3>Startups</h3>
                    <p>MVPs, first customer apps, and websites that support fundraising and early traction.</p>
                </article>
                <article class="hm-build__item">
                    <h3>Growing businesses</h3>
                    <p>Custom tools to replace spreadsheets, streamline ops, and serve customers better online.</p>
                </article>
                <article class="hm-build__item">
                    <h3>Product teams</h3>
                    <p>Extra build capacity for features, redesigns, and integrations when deadlines are tight.</p>
                </article>
            </div>
            <div class="hm-build__cta">
                <a class="hm-btn hm-btn--solid" href="{{ route('form.contact') }}">Discuss your project</a>
            </div>
        </div>
    </section>

    <section class="hm-section hm-section--alt" aria-labelledby="insights-heading">
        <div class="hm-wrap">
            <div class="hm-section__head">
                <h2 id="insights-heading">From the journal</h2>
                <p>Practical notes on apps, websites, software delivery, and building digital products.</p>
            </div>

            @if (isset($dataList) && count($dataList) > 0)
                <div class="hm-grid">
                    @foreach ($dataList as $data)
                        @php
                            $href = route('pages.blog.detail', ['slug' => $data->slug]);
                            $image = URL::asset('/images/blog/' . $data->image);
                        @endphp
                        <article>
                            <a href="{{ $href }}" class="hm-card">
                                <figure class="hm-card__media">
                                    <img src="{{ $image }}" alt="" width="640" height="360" loading="lazy"
                                        decoding="async">
                                </figure>
                                <div class="hm-card__body">
                                    <div class="hm-card__meta">
                                        <time datetime="{{ $data->created_at->toAtomString() }}">
                                            {{ $data->created_at->format('M j, Y') }}
                                        </time>
                                    </div>
                                    <h3 class="hm-card__title">{{ $data->title }}</h3>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="hm-empty" role="status">New writing will appear here soon.</div>
            @endif

            <div class="hm-section__foot">
                <a class="hm-btn hm-btn--ghost" href="{{ route('pages.blog.list') }}">Browse all articles</a>
            </div>
        </div>
    </section>

    <section class="hm-cta" aria-label="Contact">
        <div class="hm-cta__box">
            <p>Need a custom app, website, or software system? Tell us what you want to launch.</p>
            <a class="hm-btn hm-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
        </div>
    </section>

</x-layouts.site>
