<header class="site-header" id="site-header">
    <div class="site-header__inner">
        <a class="site-brand" href="{{ route('home') }}" title="GujjuTicks">
            <img src="{{ asset('brand/full-logo-black.png') }}" width="148" height="32" alt="GujjuTicks"
                class="site-brand__logo site-brand__logo--dark">
            <img src="{{ asset('brand/full-logo-white.png') }}" width="148" height="32" alt="GujjuTicks"
                class="site-brand__logo site-brand__logo--light">
        </a>

        <button type="button" class="site-nav-toggle" id="site-nav-toggle" aria-expanded="false"
            aria-controls="site-nav" aria-label="Open menu">
            <span></span>
            <span></span>
        </button>

        <nav class="site-nav" id="site-nav" aria-label="Primary">
            <a href="{{ route('home') }}"
                class="site-nav__link {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('pages.services') }}"
                class="site-nav__link {{ request()->routeIs('pages.services*') ? 'is-active' : '' }}">Services</a>
            <a href="{{ route('pages.technology') }}"
                class="site-nav__link {{ request()->routeIs('pages.technology*') ? 'is-active' : '' }}">Technology</a>
            <a href="{{ route('pages.work') }}"
                class="site-nav__link {{ request()->routeIs('pages.work*') ? 'is-active' : '' }}">Work</a>
            <a href="{{ route('pages.industries') }}"
                class="site-nav__link {{ request()->routeIs('pages.industries*') ? 'is-active' : '' }}">Industries</a>
            <a href="{{ route('pages.blog.list') }}"
                class="site-nav__link {{ request()->routeIs('pages.blog.*') ? 'is-active' : '' }}">Journal</a>
            <a href="{{ route('form.contact') }}" class="site-nav__cta">Enquire</a>
        </nav>
    </div>
</header>
