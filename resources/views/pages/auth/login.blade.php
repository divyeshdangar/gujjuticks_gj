<x-layouts.site :metaData="$metaData" page="login">

    <div class="lg-page" data-lg-page>
        <div class="lg-ambient" aria-hidden="true">
            <div class="lg-ambient__grid"></div>
            <div class="lg-ambient__blob lg-ambient__blob--a"></div>
            <div class="lg-ambient__blob lg-ambient__blob--b"></div>
        </div>

        <section class="lg-shell" aria-label="Sign in">
            <div class="lg-copy">
                <p class="lg-kicker">Account access</p>
                <p class="lg-brand">GujjuTicks</p>
                <h1 class="lg-title">Sign in to your workspace</h1>
                <p class="lg-lead">
                    Access the dashboard to manage projects, content, and delivery tools.
                    New here? Signing in with Google creates your account automatically.
                </p>
                <ul class="lg-points">
                    <li>Secure Google sign-in</li>
                    <li>Dashboard for your team tools</li>
                    <li>Same account across GujjuTicks products</li>
                </ul>
            </div>

            <div class="lg-panel">
                <div class="lg-panel__head">
                    <h2 class="lg-panel__title">Continue</h2>
                    <p class="lg-panel__hint">Use Google to sign in or create an account.</p>
                </div>

                @if ($errors->any())
                    <div class="lg-alert" role="alert">
                        <strong>Couldn’t sign in</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="lg-actions">
                    <a class="lg-btn lg-btn--google" href="{{ route('google.redirect') }}">
                        <img src="{{ asset('assets/images/google.svg') }}" alt="" width="20" height="20">
                        <span>Continue with Google</span>
                    </a>

                    <button type="button" class="lg-btn lg-btn--muted" disabled
                        title="Facebook sign-in will be available soon">
                        <img src="{{ asset('assets/images/facebook.svg') }}" alt="" width="20" height="20">
                        <span>Continue with Facebook</span>
                        <em class="lg-soon">Soon</em>
                    </button>
                </div>

                <p class="lg-note">
                    By continuing, you agree to use your account for GujjuTicks workspace access.
                </p>

                <div class="lg-links">
                    <a href="{{ route('home') }}">Back to home</a>
                    <a href="{{ route('form.contact') }}">Need help?</a>
                </div>
            </div>
        </section>
    </div>

</x-layouts.site>
