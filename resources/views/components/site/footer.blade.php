<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__brand">
            <a href="{{ route('home') }}" class="site-footer__logo" title="GujjuTicks">
                <img src="{{ asset('brand/full-logo-black.png') }}" width="140" height="30" alt="GujjuTicks"
                    class="site-footer__logo-img site-footer__logo-img--dark">
                <img src="{{ asset('brand/full-logo-white.png') }}" width="140" height="30" alt="GujjuTicks"
                    class="site-footer__logo-img site-footer__logo-img--light">
            </a>
            <p class="site-footer__tagline">
                Custom apps, websites, and software — built by GujjuTicks for startups and growing teams.
            </p>
        </div>
        <nav class="site-footer__nav" aria-label="Footer">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('pages.services') }}">Services</a>
            <a href="{{ route('pages.technology') }}">Technology</a>
            <a href="{{ route('pages.capabilities') }}">Capabilities</a>
            <a href="{{ route('pages.work') }}">Work</a>
            <a href="{{ route('pages.about') }}">About</a>
            <a href="{{ route('pages.blog.list') }}">Journal</a>
            <a href="{{ route('form.contact') }}">Contact</a>
            <a href="{{ route('pages.privacy') }}">Privacy</a>
            <a href="{{ route('pages.terms') }}">Terms</a>
        </nav>
        <p class="site-footer__copy">&copy; {{ date('Y') }} GujjuTicks</p>
    </div>
</footer>
