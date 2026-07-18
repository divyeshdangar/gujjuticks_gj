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

                    <div class="ct-field @error('goal') is-invalid @enderror">
                        <label for="goal">Project goal</label>
                        <select name="goal" id="goal">
                            <option value="" @selected(old('goal') === null || old('goal') === '')>Select one</option>
                            <option value="Custom app" @selected(old('goal') === 'Custom app')>Custom app</option>
                            <option value="Website" @selected(old('goal') === 'Website')>Website</option>
                            <option value="Custom software" @selected(old('goal') === 'Custom software')>Custom software</option>
                            <option value="MVP" @selected(old('goal') === 'MVP')>MVP</option>
                            <option value="Ongoing support" @selected(old('goal') === 'Ongoing support')>Ongoing support</option>
                            <option value="Not sure yet" @selected(old('goal') === 'Not sure yet')>Not sure yet</option>
                        </select>
                        @error('goal')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ct-field @error('timeline') is-invalid @enderror">
                        <label for="timeline">Preferred timeline</label>
                        <select name="timeline" id="timeline">
                            <option value="" @selected(old('timeline') === null || old('timeline') === '')>Select one</option>
                            <option value="ASAP" @selected(old('timeline') === 'ASAP')>ASAP</option>
                            <option value="1–2 months" @selected(old('timeline') === '1–2 months')>1–2 months</option>
                            <option value="3–6 months" @selected(old('timeline') === '3–6 months')>3–6 months</option>
                            <option value="Exploring" @selected(old('timeline') === 'Exploring')>Just exploring</option>
                        </select>
                        @error('timeline')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ct-field ct-field--full @error('budget') is-invalid @enderror">
                        <label for="budget">Budget range <span class="ct-optional">(optional)</span></label>
                        <select name="budget" id="budget">
                            <option value="" @selected(old('budget') === null || old('budget') === '')>Prefer not to say</option>
                            <option value="Under ₹1L" @selected(old('budget') === 'Under ₹1L')>Under ₹1L</option>
                            <option value="₹1L–₹3L" @selected(old('budget') === '₹1L–₹3L')>₹1L–₹3L</option>
                            <option value="₹3L–₹8L" @selected(old('budget') === '₹3L–₹8L')>₹3L–₹8L</option>
                            <option value="₹8L+" @selected(old('budget') === '₹8L+')>₹8L+</option>
                            <option value="Not sure" @selected(old('budget') === 'Not sure')>Not sure yet</option>
                        </select>
                        @error('budget')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ct-field ct-field--full @error('links') is-invalid @enderror">
                        <label for="links">Links <span class="ct-optional">(optional)</span></label>
                        <input type="text" name="links" id="links" value="{{ old('links') }}"
                            placeholder="Current site, docs, Figma, competitor — any URLs">
                        @error('links')
                            <span class="ct-field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ct-field ct-field--full @error('message') is-invalid @enderror">
                        <label for="message">Project details</label>
                        <textarea name="message" id="message" rows="5"
                            placeholder="What should users be able to do? Any must-haves, constraints, or context that helps us reply clearly.">{{ old('message') }}</textarea>
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
