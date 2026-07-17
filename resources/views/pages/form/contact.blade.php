<x-layouts.site :metaData="$metaData" page="contact">

    <section class="ct-hero">
        <div class="ct-hero__inner">
            <p class="ct-hero__label">Contact</p>
            <h1 class="ct-hero__title">Tell us about your app, website, or software project</h1>
            <p class="ct-hero__lead">
                GujjuTicks builds custom applications, websites, and business software for startups and growing teams.
                Share a short brief — or message us on WhatsApp to start faster.
            </p>
        </div>
    </section>

    <section class="ct-layout" aria-label="Contact form and details">
        <div class="ct-panel">
            <h2 class="ct-panel__title">Send a message</h2>
            <p class="ct-panel__hint">We typically respond within one business day.</p>

            <a class="ct-wa"
                href="https://wa.me/917600126800?text=Hello%20GujjuTicks%20%E2%80%94%20I%27d%20like%20to%20discuss%20a%20custom%20app%2C%20website%2C%20or%20software%20project.">
                Chat on WhatsApp
            </a>

            <div class="ct-divider" aria-hidden="true">Or</div>

            <form method="post" action="{{ route('form.contact.post') }}" novalidate>
                @csrf

                @if ($errors->any())
                    <div class="ct-errors" role="alert">
                        <strong>{{ __('dashboard.error') }}</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="ct-grid">
                    <div class="ct-field ct-field--full @error('name') is-invalid @enderror">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            placeholder="Your full name" autocomplete="name">
                        @error('name')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ct-field @error('email') is-invalid @enderror">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="you@company.com" autocomplete="email">
                        @error('email')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ct-field @error('phone') is-invalid @enderror">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="10-digit mobile" autocomplete="tel" inputmode="numeric">
                        @error('phone')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ct-field ct-field--full @error('message') is-invalid @enderror">
                        <label for="message">Project details</label>
                        <textarea name="message" id="message" rows="5"
                            placeholder="What do you need — custom app, website, or software? Include goals, timeline, and any links.">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="ct-actions">
                    <button type="submit" class="ct-submit">Send message</button>
                </div>
            </form>
        </div>

        <aside class="ct-aside">
            <div class="ct-card">
                <h2 class="ct-card__title">Direct contact</h2>
                <div class="ct-info">
                    <div>
                        <span class="ct-info__label">Email</span>
                        <a href="mailto:info@gujjuticks.com">info@gujjuticks.com</a>
                    </div>
                    <div>
                        <span class="ct-info__label">WhatsApp / Phone</span>
                        <a href="https://wa.me/917600126800">(+91) 7600 12 6800</a>
                    </div>
                    <div>
                        <span class="ct-info__label">Location</span>
                        <p>Gujarat, India</p>
                    </div>
                </div>
            </div>

            <div class="ct-card">
                <h2 class="ct-card__title">Services we take on</h2>
                <ul class="ct-services">
                    <li>Custom mobile &amp; web apps</li>
                    <li>Business &amp; marketing websites</li>
                    <li>Custom software &amp; integrations</li>
                    <li>MVP builds for startups</li>
                    <li>Ongoing product support</li>
                </ul>
            </div>

            <div class="ct-card">
                <h2 class="ct-card__title">What to include</h2>
                <p class="ct-note">
                    Goals, target users, preferred timeline, budget range if known, and any references or competitor links
                    help us reply with a clearer plan.
                </p>
            </div>
        </aside>
    </section>

</x-layouts.site>
