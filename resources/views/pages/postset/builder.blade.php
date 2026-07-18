<x-layouts.site :metaData="$metaData" page="news-post">
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    </x-slot:styles>

    @php
        $posts = $dataDetail->posts ?? collect();
        $slideCount = $posts->count();
    @endphp

    <div class="np-ambient" aria-hidden="true">
        <div class="np-ambient__grid"></div>
        <div class="np-ambient__blob np-ambient__blob--a"></div>
        <div class="np-ambient__blob np-ambient__blob--b"></div>
        <div class="np-ambient__blob np-ambient__blob--c"></div>
        <div class="np-ambient__glow" data-ambient-glow></div>
        <canvas class="np-ambient__canvas" data-ambient-canvas width="1" height="1"></canvas>
    </div>
    <div class="np-progress" data-scroll-progress aria-hidden="true"></div>

    <article class="np-detail">
        <header class="np-detail__hero">
            <div class="np-wrap np-detail__grid">
                <div class="np-detail__copy">
                    <nav class="np-crumb" aria-label="Breadcrumb">
                        <a href="{{ route('pages.postset.list') }}">News posts</a>
                        <span class="np-crumb__sep" aria-hidden="true">/</span>
                        <span aria-current="page">Set</span>
                    </nav>

                    <p class="np-live">
                        <span class="np-live__dot" aria-hidden="true"></span>
                        Live wire · Ready to personalize
                    </p>

                    @if ($dataDetail->topic)
                        <span class="np-detail__topic">{{ $dataDetail->topic }}</span>
                    @endif

                    <h1 class="np-detail__title">{{ $dataDetail->title }}</h1>

                    @if ($dataDetail->meta_description)
                        <p class="np-detail__lead">{{ $dataDetail->meta_description }}</p>
                    @endif

                    <div class="np-detail__meta">
                        @if ($slideCount > 0)
                            <span>{{ $slideCount }} slides</span>
                            <span class="np-detail__sep" aria-hidden="true">·</span>
                        @endif
                        <span>Share-ready carousel</span>
                    </div>

                    <div class="np-detail__actions">
                        <a class="np-btn np-btn--solid" href="#slides">Preview slides</a>
                        <a class="np-btn np-btn--ghost" href="#personalize">Personalize</a>
                    </div>
                </div>

                <div class="np-detail__visual" aria-hidden="true">
                    <div class="np-detail__stage">
                        <span class="np-detail__sheet np-detail__sheet--a"></span>
                        <span class="np-detail__sheet np-detail__sheet--b"></span>
                        <span class="np-detail__sheet np-detail__sheet--c"></span>
                        <span class="np-detail__ring np-detail__ring--a"></span>
                        <span class="np-detail__ring np-detail__ring--b"></span>
                        <figure class="np-detail__cover">
                            <img loading="eager" decoding="async"
                                src="{{ route('pages.image.postmain', ['slug' => $dataDetail->slug . '.jpg']) }}"
                                alt="" width="720" height="720">
                            <span class="np-detail__scan"></span>
                        </figure>
                    </div>
                </div>
            </div>
        </header>

        @if ($dataDetail->caption)
            <section class="np-section np-section--tight" aria-labelledby="caption-heading">
                <div class="np-wrap">
                    <div class="np-panel np-reveal">
                        <div class="np-panel__head">
                            <h2 id="caption-heading">Caption pack</h2>
                            <p>Copy-ready caption with hashtags for the full set.</p>
                        </div>
                        <div class="np-caption">{!! $dataDetail->caption !!}</div>
                    </div>
                </div>
            </section>
        @endif

        <section class="np-section np-section--tight" id="personalize" aria-labelledby="personalize-heading">
            <div class="np-wrap">
                @if (Auth::check())
                    <div class="np-personalize np-reveal">
                        <div class="np-personalize__intro">
                            <h2 id="personalize-heading">Manage your brand on this set</h2>
                            <p>Update your Instagram handle and logo so personalized slides stay on-brand.</p>
                        </div>
                        <form method="post" enctype="multipart/form-data"
                            action="{{ route('pages.postset.business.add') }}" class="np-form"
                            name="basicDetailsForm" id="basicDetailsForm">
                            @csrf
                            @if ($errors->any())
                                <div class="np-form__errors" role="alert">
                                    <strong>{{ __('dashboard.error') }}:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="np-field">
                                <label for="instagram"
                                    class="@error('instagram') is-invalid @enderror">Instagram username</label>
                                <input type="text"
                                    value="{{ old('instagram', $bProfile ? $bProfile->instagram : '') }}"
                                    maxlength="64" name="instagram" id="instagram" required
                                    class="@error('instagram') is-invalid @enderror">
                                @error('instagram')
                                    <p class="np-form-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="np-field" id="imageFormGroup">
                                <label for="image" class="@error('image') is-invalid @enderror">Logo image</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="@error('image') is-invalid @enderror">
                                <input type="hidden" id="croppedImage" name="croppedImage" value="">
                                @error('image')
                                    <p class="np-form-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div id="upload-image-image" class="np-crop"></div>
                            <button type="submit" class="np-btn np-btn--solid">Save brand details</button>
                        </form>
                    </div>
                @else
                    <div class="np-gate np-reveal">
                        <h2 id="personalize-heading">Login to personalize</h2>
                        <p>Add your logo and Instagram handle so this set can carry your brand across every slide.</p>
                        <a class="np-btn np-btn--solid" href="{{ route('login') }}">Login</a>
                    </div>
                @endif
            </div>
        </section>

        <section class="np-section" id="slides" aria-labelledby="slides-heading">
            <div class="np-wrap">
                <div class="np-bar np-reveal">
                    <div>
                        <h2 class="np-bar__title" id="slides-heading">Slide stack</h2>
                        <p class="np-bar__lead">
                            @if ($slideCount > 0)
                                {{ $slideCount }} curated frames for this topic.
                            @else
                                Slides for this set will appear here.
                            @endif
                        </p>
                    </div>
                    <a class="np-btn np-btn--ghost" href="{{ route('pages.postset.list') }}">All sets</a>
                </div>

                @if ($slideCount > 0)
                    <div class="np-slides">
                        @foreach ($posts as $i => $value)
                            <article class="np-slide np-reveal" style="--i: {{ $i % 8 }}">
                                <figure class="np-slide__media">
                                    <img loading="lazy" decoding="async"
                                        src="{{ route('pages.image.postset', ['slug' => $value->slug . '.jpg']) }}"
                                        alt="" width="640" height="640">
                                    <span class="np-slide__index">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                </figure>
                                <h3 class="np-slide__title">{{ $value->title }}</h3>
                                @if ($value->description)
                                    <p class="np-slide__body">{{ $value->description }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="np-empty" role="status">No slides in this set yet.</div>
                @endif
            </div>
        </section>
    </article>

    <x-slot:scripts>
        @if (Auth::check())
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>
            <script>
                (function() {
                    var $image_crop;
                    var isImageSelected = false;

                    function getImage() {
                        $('#upload-image-image').croppie('result', {
                            type: 'base64',
                            format: 'png',
                            size: { width: 255, height: 75 }
                        }).then(function(resp) {
                            $("#croppedImage").val(resp && isImageSelected ? resp : "");
                        });
                    }

                    function addCropperImage() {
                        if (!$('#upload-image-image').length) return;
                        $image_crop = $('#upload-image-image').croppie({
                            enableResize: true,
                            viewport: { width: 255, height: 75, type: 'square' },
                            boundary: {
                                width: $("#imageFormGroup").width() || 280,
                                height: 150
                            }
                            @if ($bProfile && !empty($bProfile->logo))
                                , url: '{{ URL::asset('/images/business/logo/' . $bProfile->logo) }}'
                            @endif
                        });
                        $('#image').on('change', function() {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $image_crop.croppie('bind', { url: e.target.result }).then(function() {
                                    isImageSelected = true;
                                });
                            };
                            if (this.files && this.files[0]) reader.readAsDataURL(this.files[0]);
                        });
                    }

                    window.addEventListener('load', function() {
                        addCropperImage();
                        $("#basicDetailsForm").on('submit', function() {
                            getImage();
                            return true;
                        });
                    });
                })();
            </script>
        @endif
    </x-slot:scripts>
</x-layouts.site>
