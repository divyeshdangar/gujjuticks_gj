<x-layouts.site :metaData="$metaData" page="home">

    <section class="hm-hero">
        <div class="hm-hero__copy">
            <p class="hm-live" data-live-status>
                <span class="hm-live__dot" aria-hidden="true"></span>
                <span data-live-label>Available for new projects</span>
            </p>
            <p class="hm-hero__brand">GujjuTicks</p>
            <h1 class="hm-hero__title">Custom apps, websites, and software — built for growing teams.</h1>
            <p class="hm-hero__lead">
                GujjuTicks is a software startup that designs and develops custom applications, modern websites,
                and business software so you can launch faster and operate with confidence.
            </p>
            <div class="hm-hero__actions">
                <a class="hm-btn hm-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="hm-btn hm-btn--ghost" href="#services">Explore services</a>
            </div>
            <p class="hm-hero__meta">
                <span data-local-time>—</span>
                <span class="hm-hero__sep" aria-hidden="true">·</span>
                Avg. reply within 1 business day
            </p>
        </div>
        <div class="hm-hero__visual">
            <img src="{{ asset('brand/pages/gujjuticks-homepage.png') }}" alt="" width="1600" height="900"
                loading="eager" decoding="async">
            <div class="hm-hero__orb" aria-hidden="true"></div>
            <div class="hm-hero__scan" aria-hidden="true"></div>
        </div>
    </section>

    <div class="hm-ticker" aria-hidden="true">
        <div class="hm-ticker__track">
            @foreach ([1, 2] as $loopCopy)
                <span>Custom apps</span>
                <span>Websites</span>
                <span>Business software</span>
                <span>MVP development</span>
                <span>Dashboards</span>
                <span>Integrations</span>
                <span>Product launches</span>
                <span>Ongoing support</span>
            @endforeach
        </div>
    </div>

    <section class="hm-section" id="services" aria-labelledby="services-heading">
        <div class="hm-wrap">
            <div class="hm-section__head hm-reveal">
                <h2 id="services-heading">What we provide</h2>
                <p>
                    End-to-end delivery for startups and businesses that need a dependable build partner —
                    from first version to ongoing improvements.
                </p>
            </div>
            <div class="hm-build">
                <article class="hm-build__item hm-reveal" data-tilt>
                    <p class="hm-build__tag">01</p>
                    <h3>Custom apps</h3>
                    <p>
                        Mobile and web applications tailored to your workflows — dashboards, customer portals,
                        internal tools, and product MVPs ready for real users.
                    </p>
                    <ul class="hm-build__list">
                        <li>Web &amp; mobile product apps</li>
                        <li>Admin dashboards &amp; portals</li>
                        <li>MVP to production releases</li>
                    </ul>
                </article>
                <article class="hm-build__item hm-reveal" data-tilt>
                    <p class="hm-build__tag">02</p>
                    <h3>Websites</h3>
                    <p>
                        Fast, clear marketing and product websites that present your brand well, convert visitors,
                        and stay easy to update as you grow.
                    </p>
                    <ul class="hm-build__list">
                        <li>Startup &amp; company sites</li>
                        <li>Landing pages that convert</li>
                        <li>CMS-friendly updates</li>
                    </ul>
                </article>
                <article class="hm-build__item hm-reveal" data-tilt>
                    <p class="hm-build__tag">03</p>
                    <h3>Custom software</h3>
                    <p>
                        Business systems and integrations that automate operations, connect your tools,
                        and reduce manual work across teams.
                    </p>
                    <ul class="hm-build__list">
                        <li>Internal business tools</li>
                        <li>API &amp; system integrations</li>
                        <li>Automation workflows</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="hm-stats" aria-label="GujjuTicks highlights">
        <div class="hm-wrap hm-stats__grid">
            <div class="hm-stats__item hm-reveal">
                <p class="hm-stats__value"><span data-count="3" data-suffix="">0</span></p>
                <p class="hm-stats__label">Core services</p>
            </div>
            <div class="hm-stats__item hm-reveal">
                <p class="hm-stats__value"><span data-count="4" data-suffix="-step">0</span></p>
                <p class="hm-stats__label">Delivery process</p>
            </div>
            <div class="hm-stats__item hm-reveal">
                <p class="hm-stats__value"><span data-count="1" data-suffix=" day">0</span></p>
                <p class="hm-stats__label">Typical first reply</p>
            </div>
            <div class="hm-stats__item hm-reveal">
                <p class="hm-stats__value"><span data-count="24" data-suffix="/7">0</span></p>
                <p class="hm-stats__label">Idea intake online</p>
            </div>
        </div>
    </section>

    <section class="hm-section hm-section--alt" id="how-we-work" aria-labelledby="process-heading">
        <div class="hm-wrap">
            <div class="hm-section__head hm-reveal">
                <h2 id="process-heading">How we work</h2>
                <p>A clear process so you always know what happens next. Hover or tap a step to focus it.</p>
            </div>
            <ol class="hm-steps" data-steps>
                <li class="hm-steps__item is-active hm-reveal" tabindex="0">
                    <span class="hm-steps__num" aria-hidden="true">01</span>
                    <div>
                        <h3>Discover</h3>
                        <p>We clarify goals, users, timeline, and constraints in a short kickoff.</p>
                    </div>
                </li>
                <li class="hm-steps__item hm-reveal" tabindex="0">
                    <span class="hm-steps__num" aria-hidden="true">02</span>
                    <div>
                        <h3>Design &amp; plan</h3>
                        <p>You get a clear scope, milestones, and UI direction before heavy build work starts.</p>
                    </div>
                </li>
                <li class="hm-steps__item hm-reveal" tabindex="0">
                    <span class="hm-steps__num" aria-hidden="true">03</span>
                    <div>
                        <h3>Build &amp; launch</h3>
                        <p>We ship in iterations, test with you, and go live with a stable release.</p>
                    </div>
                </li>
                <li class="hm-steps__item hm-reveal" tabindex="0">
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
            <div class="hm-section__head hm-reveal">
                <h2 id="help-heading">Who we help</h2>
                <p>Founders and operators who need a capable software partner without a full in-house team.</p>
            </div>
            <div class="hm-build">
                <article class="hm-build__item hm-reveal">
                    <h3>Startups</h3>
                    <p>MVPs, first customer apps, and websites that support fundraising and early traction.</p>
                </article>
                <article class="hm-build__item hm-reveal">
                    <h3>Growing businesses</h3>
                    <p>Custom tools to replace spreadsheets, streamline ops, and serve customers better online.</p>
                </article>
                <article class="hm-build__item hm-reveal">
                    <h3>Product teams</h3>
                    <p>Extra build capacity for features, redesigns, and integrations when deadlines are tight.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="hm-section hm-section--alt" id="capabilities" aria-labelledby="cap-heading">
        <div class="hm-wrap">
            <div class="hm-section__head hm-reveal">
                <h2 id="cap-heading">What you can expect</h2>
                <p>Practical standards we bring to every engagement.</p>
            </div>
            <div class="hm-caps">
                <article class="hm-caps__item hm-reveal">
                    <h3>Clear scope</h3>
                    <p>Defined milestones, timelines, and deliverables before major build work begins.</p>
                </article>
                <article class="hm-caps__item hm-reveal">
                    <h3>Modern stack</h3>
                    <p>Reliable web technologies suited to apps, websites, and long-term maintainability.</p>
                </article>
                <article class="hm-caps__item hm-reveal">
                    <h3>Direct communication</h3>
                    <p>Fast updates via email or WhatsApp — no layers between you and the build team.</p>
                </article>
                <article class="hm-caps__item hm-reveal">
                    <h3>Launch readiness</h3>
                    <p>Testing, handover notes, and optional ongoing support after go-live.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="hm-section" id="faq" aria-labelledby="faq-heading">
        <div class="hm-wrap hm-faq-wrap">
            <div class="hm-section__head hm-reveal">
                <h2 id="faq-heading">Common questions</h2>
                <p>Quick answers before you reach out.</p>
            </div>
            <div class="hm-faq" data-faq>
                <details class="hm-faq__item hm-reveal">
                    <summary>What kinds of projects do you take?</summary>
                    <p>Custom apps, marketing/product websites, internal business software, MVPs, and integrations for startups and growing teams.</p>
                </details>
                <details class="hm-faq__item hm-reveal">
                    <summary>How do projects usually start?</summary>
                    <p>Send a short brief on Contact or WhatsApp. We clarify goals and timeline, then propose scope and next steps.</p>
                </details>
                <details class="hm-faq__item hm-reveal">
                    <summary>Do you support projects after launch?</summary>
                    <p>Yes. We can maintain, fix, and add features as your product or business grows.</p>
                </details>
                <details class="hm-faq__item hm-reveal">
                    <summary>Where are you based?</summary>
                    <p>Gujarat, India — working with clients locally and internationally online.</p>
                </details>
            </div>
            <div class="hm-build__cta hm-reveal">
                <a class="hm-btn hm-btn--solid" href="{{ route('form.contact') }}">Discuss your project</a>
            </div>
        </div>
    </section>

    <section class="hm-section hm-section--alt" aria-labelledby="insights-heading">
        <div class="hm-wrap">
            <div class="hm-section__head hm-reveal">
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
                        <article class="hm-reveal">
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

            <div class="hm-section__foot hm-reveal">
                <a class="hm-btn hm-btn--ghost" href="{{ route('pages.blog.list') }}">Browse all articles</a>
            </div>
        </div>
    </section>

    <section class="hm-cta" aria-label="Contact">
        <div class="hm-cta__box hm-reveal">
            <div>
                <p class="hm-cta__live">
                    <span class="hm-live__dot" aria-hidden="true"></span>
                    Open for project inquiries
                </p>
                <p>Need a custom app, website, or software system? Tell us what you want to launch.</p>
            </div>
            <div class="hm-cta__actions">
                <a class="hm-btn hm-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="hm-btn hm-btn--ghost"
                    href="https://wa.me/917600126800?text=Hello%20GujjuTicks%20%E2%80%94%20I%27d%20like%20to%20discuss%20a%20custom%20app%2C%20website%2C%20or%20software%20project.">WhatsApp</a>
            </div>
        </div>
    </section>

</x-layouts.site>
