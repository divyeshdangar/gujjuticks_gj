<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">GujjuTalks - Read, Relate, Repeat</h6>
                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'Gujju.Me',
                            '<a href="https://gujju.me"><span class="text-warning fw-bold">Gujju.Me</span></a>',
                            'Your Gujarati Identity, One Link Away - Gujju.Me',
                        ) !!}</h1>
                        <p class="lead text-muted mb-0">{{ $metaData['description'] }}</p>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0 h-100">
                                <a class="btn btn-warning" style="color: rgb(19, 19, 19) !important;"
                                    href="#reserve-link-now">Create Your Page</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img src="{{ asset('files/images/gujjuticks-resume-builder.png') }}" alt=""
                            class="home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="reserve-link-now">
        <div class="container">
            <form method="post" action="{{ route('pages.link.post') }}">
                {{ csrf_field() }}
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-4 text-center mb-4">
                        <img src="{{ asset('logos/gujju.me.white.png') }}" alt="" class="home-img w-75" />
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 text-center">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="username" class="form-label">Find your username now!</label>
                                <div
                                    class="input-group input-group-lg @error('username') border border-danger border-1 rounded-3 @enderror">
                                    <span class="input-group-text" id="username-link"><span
                                            class="d-none d-md-inline">https://</span>gujju.me/</span>
                                    <input type="text" class="form-control" autocomplete="off" id="username" onkeyup="updateUrl(this, 'username')" name="username" maxlength="255" value="{{ old('username') }}" minlength="3" aria-describedby="username-link username-description">
                                </div>
                                <div class="form-text" id="username-description">Example help text goes outside the
                                    input group.</div>
                                <div class="text-danger text-start d-none" id="link-error">
                                    <ul class="mt-1">
                                        <li>Invalid link</li>
                                        <li>Must be at least <b>4 characters</b> long</li>
                                        <li>Start with a letter</li>
                                        <li>Can include numbers and single hyphens</li>
                                        <li>Must end with a letter or number</li>
                                        <li>Ex. <span class="text-warning">test</span>, <span
                                                class="text-warning">test-page-one</span>, <span
                                                class="text-warning">test-page-1</span> etc</li>
                                    </ul>
                                </div>
                                @error('username')
                                    <div class="h3 text-center mt-3 text-danger">{{ $message }}</div>
                                @enderror
                                @if (session('success'))
                                    <div class="h3 text-center mt-3 text-success shake-text">{{ session('success') }}</div>
                                    @if (auth()->user())
                                        
                                    @else
                                        <p class="text-warning"></p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-warning d-none" style="color: rgb(19, 19, 19) !important;"
                            id="subBut">Check if Available</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Why Use <a href="https://gujju.me" target="_blank">Gujju.Me</a>?
                        </h2>
                        <p class="text-muted mb-5"><a href="https://gujju.me" target="_blank">Gujju.Me</a> is your
                            all-in-one digital link page made for the Gujarati community. Whether you want to share all
                            your social media in one link or showcase 50+ products without flooding your client’s
                            WhatsApp, <a href="https://gujju.me" target="_blank">Gujju.Me</a> makes it simple and
                            beautiful. Short, mobile-friendly, and easy to share, it helps you look professional and
                            stay connected - all with just one smart link.</p>

                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <img loading="lazy" src="{{ URL::asset('/images/link/icons/link-page.png') }}"
                                        class="border p-3 rounded-4 mb-2 bg-warning" alt=""
                                        title="Gujjuticks image" height="128px" width="128px">
                                    <h3 class="h4">Smart Bio Link Page</h3>
                                    <p class="text-muted">Add all your social media, website, WhatsApp, YouTube & more -
                                        all in one place.</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <img loading="lazy" src="{{ URL::asset('/images/link/icons/products.png') }}"
                                        class="border p-3 rounded-4 mb-2 bg-warning" alt=""
                                        title="Gujjuticks image" height="128px" width="128px">
                                    <h3 class="h4">Product Showcase</h3>
                                    <p class="text-muted">Sell or display 10, 20, even 50+ items without spamming
                                        images. Just send one link.</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <img loading="lazy" src="{{ URL::asset('/images/link/icons/messages.png') }}"
                                        class="border p-3 rounded-4 mb-2 bg-warning" alt=""
                                        title="Gujjuticks image" height="128px" width="128px">
                                    <h3 class="h4">Made for WhatsApp & SMS</h3>
                                    <p class="text-muted">Easy-to-type, short & sweet Gujju.Me links perfect for mobile
                                        sharing.</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <img loading="lazy" src="{{ URL::asset('/images/link/icons/7832467.png') }}"
                                        class="border p-3 rounded-4 mb-2 bg-warning" alt=""
                                        title="Gujjuticks image" height="128px" width="128px">
                                    <h3 class="h4">Custom Branding</h3>
                                    <p class="text-muted">Add your photo, name, logo, and custom button colors to match
                                        your identity.</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <img loading="lazy" src="{{ URL::asset('/images/link/icons/analytics.png') }}"
                                        class="border p-3 rounded-4 mb-2 bg-warning" alt=""
                                        title="Gujjuticks image" height="128px" width="128px">
                                    <h3 class="h4">Track Clicks (Coming Soon)</h3>
                                    <p class="text-muted">Know what your visitors click with basic analytics.</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <img loading="lazy" src="{{ URL::asset('/images/link/icons/trusted.png') }}"
                                        class="border p-3 rounded-4 mb-2 bg-warning" alt=""
                                        title="Gujjuticks image" height="128px" width="128px">
                                    <h3 class="h4">Powered by GujjuTicks.com</h3>
                                    <p class="text-muted">Trusted by the growing Gujarati creator community.</p>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4 pt-2">
                            <a class="btn btn-warning btn-hover" style="color: rgb(19, 19, 19) !important;"
                                href="#reserve-link-now">Reserve Link Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title me-5">
                        <h3 class="title text-warning">How It Work</h3>
                        <p class="text-muted">Gujju.Me makes it easy to create and share your own smart link page in
                            just minutes. Simply log in to GujjuTicks.com, add your social links, product images, and
                            details, and your personalized Gujju.Me link is ready to go. Share it on WhatsApp, SMS, or
                            Instagram - and let people explore everything you offer, all in one place.</p>
                        <div class="process-menu nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <div class="nav-link active">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0 bg-warning"
                                        style="color: rgb(19, 19, 19) !important;">
                                        1
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18 text-warning">Login to GujjuTicks.com</h5>
                                        <p class="text-muted mb-0">Start by logging into your GujjuTicks account. If
                                            you don’t have one, it only takes a few seconds to sign up. This is your
                                            control center to manage everything from your profile to your Gujju.Me page.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="nav-link active">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0 bg-warning"
                                        style="color: rgb(19, 19, 19) !important;">
                                        2
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18 text-warning">Create Your Gujju.Me Page</h5>
                                        <p class="text-muted mb-0">Add your name, profile photo, social media links,
                                            and products — all in a clean and simple layout. You can customize your page
                                            to reflect your personal or business brand.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="nav-link active">
                                <div class=" d-flex">
                                    <div class="number flex-shrink-0 bg-warning"
                                        style="color: rgb(19, 19, 19) !important;">
                                        3
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18 text-warning">Share Your Gujju.Me Link</h5>
                                        <p class="text-muted mb-0">Once your page is ready, share your unique Gujju.Me
                                            link with clients, followers, or friends on WhatsApp, SMS, Instagram, or
                                            anywhere online - one link does it all!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Plan & Pricing</h2>
                        <b>Simple & Affordable</b>
                        <p class="text-muted mb-5">Whether you're just starting or already growing your online
                            presence, Gujju.Me offers flexible plans to fit your needs — with no hidden costs.</p>
                        <div class="row align-items-center justify-content-center text-start">
                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">🟢 Free Plan - Always Free</h3>
                                    <p class="text-muted">Perfect for individuals, home sellers, and freelancers who
                                        want a clean, shareable link page.</p>
                                    <ul class="text-start">
                                        <li>Create your personalized Gujju.Me link</li>
                                        <li>Add up to 10 links or product items</li>
                                        <li>Customize profile photo, name, and buttons</li>
                                        <li>Hosted on Gujju.Me - short and easy to share</li>
                                        <li>Edit anytime from your GujjuTicks</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">🟡 Premium Plan (Coming Soon)</h3>
                                    <p class="text-muted">For power users, small businesses, and brands who need more
                                        features and control.</p>
                                    <ul class="text-start">
                                        <li>Add unlimited links/products</li>
                                        <li>Access to basic analytics (views & clicks)</li>
                                        <li>Priority support via WhatsApp or email</li>
                                        <li>Advanced design & branding options</li>
                                        <li>Early access to new features</li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4 pt-2">
                            <b class="d-block mb-4">No credit card required. Just sign up and start sharing!</b>
                            <a class="btn btn-warning btn-hover" style="color: rgb(19, 19, 19) !important;"
                                href="#reserve-link-now">Start for Free</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Who is it for?</h2>
                        <b>From small sellers to social stars - Gujju.Me is built for everyone who wants to share
                            smarter.</b>
                        <p class="text-muted mb-5">Whether you're running a home business or growing your digital
                            brand, Gujju.Me helps you present everything in one clean, shareable link. No more sending
                            20 images on WhatsApp or juggling multiple links — just one page that does it all.</p>
                        <div class="row align-items-center justify-content-center text-start">
                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">🍰 Home-based Sellers</h3>
                                    <p class="text-muted">Showcase your handmade products like pickles, crafts, mehndi,
                                        or snacks in a neat catalog link.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">👗 Boutique & Jewelry Shops</h3>
                                    <p class="text-muted">Display your collections, new arrivals, and WhatsApp order
                                        button on a stylish branded page.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">🧁 Bakers & Food Vendors</h3>
                                    <p class="text-muted">Menu, photos, pricing - everything clients need before
                                        placing an order on WhatsApp.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">📸 Photographers & Designers</h3>
                                    <p class="text-muted">Use your Gujju.Me page as a mini portfolio with social links
                                        and booking/contact info.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">🎥 Content Creators & Influencers</h3>
                                    <p class="text-muted">Add Instagram, YouTube, Telegram, WhatsApp, and promote your
                                        collabs - all in one tap.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">🧑‍🔧 Freelancers & Service Providers</h3>
                                    <p class="text-muted">Whether you’re a web developer, mehndi artist, tutor, or
                                        makeup artist - Gujju.Me gives you a mini landing page for instant trust.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="rounded-4 border p-2 py-3 text-center mb-4">
                                    <h3 class="h4">🛺 Local Taxi / Auto Drivers & Agents</h3>
                                    <p class="text-muted">List your services, location, contact, and even driver
                                        profiles. Great for local reach and WhatsApp inquiries.</p>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4 pt-2">
                            <a class="btn btn-warning btn-hover" style="color: rgb(19, 19, 19) !important;"
                                href="#reserve-link-now">Reserve Link Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-warning text-center mb-4">✨ Make Your First Impression Count</h2>
                    <p class="text-muted mb-3">🚀 Whether you're a creator, seller, or service provider — your audience
                        decides in seconds. With Gujju.Me, you give them a beautiful, organized page that tells your
                        story, shows your products, and connects them to everything that matters.</p>
                    <p class="text-muted mb-3">🌟 No coding. No confusion. Just one smart link that works everywhere —
                        from WhatsApp and Instagram to SMS and DMs.</p>
                    <p class="text-muted mb-3">💡 It’s time to stop sending scattered links and start sharing like a
                        pro.</p>
                    <b class="text-warning text-center d-block">Your brand deserves a better first impression.</b>
                    <h3 class="text-warning text-center mb-4 mt-5">🎯 Create Your Gujju.Me Page Today</h3>
                    <div class="mt-4 pt-2 text-center">
                        <a class="btn btn-warning btn-hover" style="color: rgb(19, 19, 19) !important;"
                            href="#reserve-link-now">Get Started - It’s Free</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-warning text-center mb-4">Frequntly Asked Questions!</h2>
                    <p class="text-muted text-center mb-5">Whether you're just starting your career or making a bold
                        move, our resume builder is tailored to help you shine. It’s made for everyone who wants a
                        resume that gets noticed.</p>
                    <div class="accordion accordion-flush faq-box" id="support">
                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button btn-secondary rounded-3 text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true"
                                    aria-controls="collapse1">
                                    🤔 What is Gujju.Me?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Gujju.Me is a simple link page that lets you share all your important links, social
                                    profiles, and even products in one place — perfect for WhatsApp, Instagram, or SMS.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"
                                    aria-expanded="false" aria-controls="collapse2">
                                    💸 Is it really free to use?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Yes! Our Free Plan gives you everything you need to create your Gujju.Me page with
                                    up to 10 links or product items. No payment or credit card needed.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse3"
                                    aria-expanded="false" aria-controls="collapse3">
                                    📦 What can I add to my Gujju.Me page?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    You can add: <br>
                                    <ul>
                                        <li>Social media links (Instagram, YouTube, etc.)</li>
                                        <li>WhatsApp contact button</li>
                                        <li>Product photos and details</li>
                                        <li>Website or portfolio links</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse4"
                                    aria-expanded="false" aria-controls="collapse4">
                                    🧁 Can I use this to sell my products?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Absolutely! If you're a home seller, artist, or shop owner, Gujju.Me is perfect to
                                    display your products neatly and share one link with clients instead of sending
                                    dozens of images.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse5"
                                    aria-expanded="false" aria-controls="collapse5">
                                    📱 Can I share my Gujju.Me link on WhatsApp?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Yes! That’s what it’s made for. Gujju.Me links are short, mobile-friendly, and easy
                                    to share on WhatsApp, SMS, Instagram bio, or anywhere else.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq6">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse6"
                                    aria-expanded="false" aria-controls="collapse6">
                                    🌍 What does the Gujju.Me link look like?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Your link will look something like: <br>
                                    👉 <strong class="text-warning">Gujju.Me/yourname</strong><br>
                                    It’s clean, personal, and proudly represents the Gujarati community.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq7">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse7"
                                    aria-expanded="false" aria-controls="collapse7">
                                    🚀 What is the Premium Plan and when will it launch?
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="faq7"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Our Premium Plan (coming soon) will include:<br>
                                    - Unlimited links/products<br>
                                    - Click tracking & analytics<br>
                                    - Custom branding<br>
                                    - Priority support<br>
                                    Stay tuned for updates!
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq8">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse8"
                                    aria-expanded="false" aria-controls="collapse8">
                                    🔐 Is my data safe?
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="faq8"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Yes, we respect your privacy. All data is securely stored and only visible to you
                                    and people you share your public page with.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="text-center mt-5">
                        <a target="_blank"
                            href="https://wa.me/917600126800?text=How%20can%20i%20get%20more%20information%20on%20Link%20Page"
                            class="btn btn-success btn-hover mt-2">Whatsapp</a>
                        <a target="_blank" href="{{ route('form.contact.post') }}"
                            class="btn btn-primary btn-hover mt-2 ms-md-2">Contact Us</a>
                        <a target="_blank" href="mailto:support@gujjuticks.com"
                            class="btn btn-warning btn-hover mt-2 ms-md-2">Email Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function updateUrl(obj, id) {
            var link = obj.value;
            const error = document.getElementById("link-error");
            const subBut = document.getElementById("subBut");
            const linkPattern = /^[a-zA-Z](?!.*--)[a-zA-Z0-9-]{2,}[a-zA-Z0-9]$/;

            if (!linkPattern.test(link)) {
                error.classList.remove('d-none');
                document.getElementById(id).innerHTML = '';
                subBut.classList.add('d-none');
            } else {
                document.getElementById(id).innerHTML = link;
                error.classList.add('d-none');
                subBut.classList.remove('d-none');
            }
        }
    </script>
</x-layouts.front>
