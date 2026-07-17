<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__brand">
            <a href="{{ route('home') }}" class="site-footer__logo" title="GujjuTicks">
                <img src="{{ asset('brand/full-logo-black.png') }}" width="140" height="32" alt="GujjuTicks">
            </a>
            <p class="site-footer__tagline">Software, tech products, and AI tools — built to ship.</p>
        </div>
        <nav class="site-footer__nav" aria-label="Footer">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('pages.blog.list') }}">Blogs</a>
            <a href="{{ route('form.contact') }}">Contact</a>
        </nav>
        <p class="site-footer__copy">&copy; {{ date('Y') }} GujjuTicks. All rights reserved.</p>
    </div>
</footer>
