<x-layouts.site :metaData="$metaData" page="image-editor">
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    </x-slot:styles>

    @php
        $fields = $dataDetail->data ?? collect();
        $editable = $fields->where('is_editable', true);
        $saved = (!empty($imageData) && is_array($imageData->options ?? null)) ? $imageData->options : [];
        $previewUrl = !empty($imageData)
            ? route('pages.image.detail', ['slug' => $dataDetail->slug, 'id' => $imageData->slug])
            : route('pages.image.detail', ['slug' => $dataDetail->slug]);
        $downloadUrl = !empty($imageData)
            ? route('pages.image.detail', ['slug' => $dataDetail->slug, 'id' => $imageData->slug, 'download' => '1'])
            : null;
        $templateImage = !empty($dataDetail->image)
            ? asset('images/dynamic/' . $dataDetail->image)
            : $previewUrl;
        $imgW = max(1, (int) ($dataDetail->width ?: 800));
        $imgH = max(1, (int) ($dataDetail->height ?: 800));
    @endphp

    <div class="ie-hub" data-ie-hub>
        <div class="ie-ambient" aria-hidden="true">
            <div class="ie-ambient__grid"></div>
            <div class="ie-ambient__blob ie-ambient__blob--a"></div>
            <div class="ie-ambient__blob ie-ambient__blob--b"></div>
            <div class="ie-ambient__glow" data-ie-glow></div>
        </div>
        <div class="ie-progress" data-ie-progress aria-hidden="true"></div>

        <section class="ie-hero" aria-label="Image creator">
            <div class="ie-wrap ie-hero__grid">
                <div class="ie-hero__copy">
                    <p class="ie-live">
                        <span class="ie-live__dot" aria-hidden="true"></span>
                        Template studio · Ready to personalize
                    </p>
                    <p class="ie-hero__brand">GujjuTicks</p>
                    <h1 class="ie-hero__title">{{ $dataDetail->title }}</h1>
                    @if ($dataDetail->meta_description)
                        <p class="ie-hero__lead">{{ $dataDetail->meta_description }}</p>
                    @else
                        <p class="ie-hero__lead">
                            Fill in a few details, generate a polished image from this template, then download or share.
                        </p>
                    @endif
                    <div class="ie-hero__actions">
                        <a class="ie-btn ie-btn--solid" href="#create-now">Create image</a>
                        @if ($downloadUrl)
                            <a class="ie-btn ie-btn--ghost" href="{{ $downloadUrl }}">Download last</a>
                        @endif
                    </div>
                    <p class="ie-hero__meta">
                        {{ (int) ($dataDetail->width ?? 0) }}×{{ (int) ($dataDetail->height ?? 0) }}
                        <span class="ie-hero__sep">·</span>
                        {{ $editable->count() }} editable field{{ $editable->count() === 1 ? '' : 's' }}
                    </p>
                </div>

                <div class="ie-hero__visual" aria-hidden="true" style="--ie-w: {{ $imgW }}; --ie-h: {{ $imgH }};">
                    <div class="ie-hero__frame ie-hero__frame--a"></div>
                    <div class="ie-hero__frame ie-hero__frame--b"></div>
                    <figure class="ie-hero__preview">
                        <img src="{{ $templateImage }}" alt="" width="{{ $imgW }}" height="{{ $imgH }}"
                            loading="eager" decoding="async">
                        <span class="ie-hero__scan"></span>
                    </figure>
                </div>
            </div>
        </section>

        <section class="ie-section" id="create-now" aria-labelledby="ie-create-heading">
            <div class="ie-wrap">
                <div class="ie-bar ie-reveal">
                    <div>
                        <h2 class="ie-bar__title" id="ie-create-heading">Create your image</h2>
                        <p class="ie-bar__lead">Update the fields, then generate a fresh preview from this template.</p>
                    </div>
                </div>

                <form method="post" enctype="multipart/form-data" class="ie-studio ie-reveal"
                    name="basicDetailsForm" id="basicDetailsForm"
                    action="{{ route('pages.image.editor.post', ['slug' => $dataDetail->slug]) }}">
                    @csrf
                    <input type="hidden" name="image_id" value="{{ $dataDetail->id }}">

                    <div class="ie-studio__form">
                        @if ($errors->any())
                            <div class="ie-errors" role="alert">
                                <strong>{{ __('dashboard.error') }}:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @forelse ($editable as $value)
                            @if ($value->type === 'text')
                                <div class="ie-field">
                                    <label for="{{ $value->random_identity }}">{{ $value->form_title }}</label>
                                    <input type="text" name="{{ $value->random_identity }}"
                                        id="{{ $value->random_identity }}"
                                        value="{{ $saved[$value->random_identity] ?? $value->text }}">
                                    @if ($value->form_description)
                                        <p class="ie-field__hint">{{ $value->form_description }}</p>
                                    @endif
                                </div>
                            @elseif ($value->type === 'paragraph')
                                <div class="ie-field">
                                    <label for="{{ $value->random_identity }}">{{ $value->form_title }}</label>
                                    <textarea name="{{ $value->random_identity }}" id="{{ $value->random_identity }}"
                                        rows="3">{{ $saved[$value->random_identity] ?? $value->text }}</textarea>
                                    @if ($value->form_description)
                                        <p class="ie-field__hint">{{ $value->form_description }}</p>
                                    @endif
                                </div>
                            @elseif ($value->type === 'image')
                                <div class="ie-field">
                                    <label for="{{ $value->random_identity }}">{{ $value->form_title }}</label>
                                    <input type="file" name="{{ $value->random_identity }}"
                                        id="{{ $value->random_identity }}" class="image-crop"
                                        accept="image/*" height="{{ $value->height }}"
                                        width="{{ $value->width }}">
                                    <input type="hidden" id="{{ $value->random_identity }}--iMage"
                                        name="{{ $value->random_identity }}--iMage" value="">
                                    @if ($value->form_description)
                                        <p class="ie-field__hint">{{ $value->form_description }}</p>
                                    @endif
                                </div>
                            @endif
                        @empty
                            <p class="ie-empty">This template has no editable fields right now.</p>
                        @endforelse

                        <div class="ie-studio__actions">
                            <button type="submit" class="ie-btn ie-btn--solid">Create now</button>
                            @if ($downloadUrl)
                                <a class="ie-btn ie-btn--ghost" href="{{ $downloadUrl }}">Download</a>
                            @endif
                        </div>
                    </div>

                    <div class="ie-studio__preview" style="--ie-w: {{ $imgW }}; --ie-h: {{ $imgH }};">
                        <p class="ie-studio__preview-label">
                            @if (!empty($imageData))
                                Your generated preview
                            @else
                                Template preview
                            @endif
                        </p>
                        <figure class="ie-studio__frame">
                            <img src="{{ $previewUrl }}"
                                title="{{ $dataDetail->image_title }}"
                                alt="{{ $dataDetail->image_alt ?: $dataDetail->title }}"
                                width="{{ $imgW }}"
                                height="{{ $imgH }}"
                                loading="lazy" decoding="async">
                        </figure>
                    </div>
                </form>
            </div>
        </section>

        <section class="ie-section ie-section--alt" aria-labelledby="ie-how-heading">
            <div class="ie-wrap">
                <div class="ie-bar ie-reveal">
                    <div>
                        <h2 class="ie-bar__title" id="ie-how-heading">How it works</h2>
                        <p class="ie-bar__lead">Three steps from form fields to a share-ready image.</p>
                    </div>
                </div>
                <ol class="ie-steps">
                    <li class="ie-steps__item ie-reveal">
                        <span class="ie-steps__num">01</span>
                        <h3>Fill in your details</h3>
                        <p>Enter the text and images this template needs — only the fields that matter for this design.</p>
                    </li>
                    <li class="ie-steps__item ie-reveal" style="--i: 1">
                        <span class="ie-steps__num">02</span>
                        <h3>Generate automatically</h3>
                        <p>We place your inputs into the ready-made layout. No design tools or resizing required.</p>
                    </li>
                    <li class="ie-steps__item ie-reveal" style="--i: 2">
                        <span class="ie-steps__num">03</span>
                        <h3>Download or share</h3>
                        <p>Preview the result, then download a high-quality image ready to post or print.</p>
                    </li>
                </ol>
            </div>
        </section>
    </div>

    <dialog class="ie-crop" data-ie-crop aria-labelledby="ie-crop-title">
        <div class="ie-crop__panel">
            <div class="ie-crop__head">
                <h2 id="ie-crop-title">Crop image</h2>
                <button type="button" class="ie-crop__close" data-ie-crop-close aria-label="Close">&times;</button>
            </div>
            <div class="ie-crop__body" id="canvasContainer">
                <div id="upload-image-image"></div>
            </div>
            <div class="ie-crop__foot">
                <button type="button" class="ie-btn ie-btn--ghost" data-ie-crop-close>Close</button>
                <button type="button" class="ie-btn ie-btn--solid" data-ie-crop-set>Set image</button>
            </div>
        </div>
    </dialog>

    <x-slot:scripts>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>
        <script>
            (function() {
                var $image_crop;
                var selectedImage;
                var isImageSelected = false;
                var cropDialog = document.querySelector("[data-ie-crop]");

                function openCrop() {
                    if (cropDialog && cropDialog.showModal) cropDialog.showModal();
                    else if (cropDialog) cropDialog.setAttribute("open", "");
                }

                function closeCrop() {
                    if (cropDialog && cropDialog.close) cropDialog.close();
                    else if (cropDialog) cropDialog.removeAttribute("open");
                }

                function getImage() {
                    if (!$image_crop || !selectedImage) return;
                    $("#upload-image-image").croppie("result", {
                        type: "base64",
                        format: "png",
                        size: {
                            width: selectedImage.width,
                            height: selectedImage.height
                        },
                        quality: 0.7
                    }).then(function(resp) {
                        if (resp && isImageSelected) {
                            $("#" + selectedImage.element).val(resp);
                            closeCrop();
                        }
                    });
                }

                function bindCropper() {
                    var el = document.getElementById("upload-image-image");
                    if (!el || !selectedImage) return;
                    var containerWidth = el.offsetWidth || 320;
                    var viewportHeight = (containerWidth / selectedImage.width) * selectedImage.height;

                    if (!$image_crop) {
                        $image_crop = $("#upload-image-image").croppie({
                            enableResize: true,
                            viewport: {
                                width: containerWidth / 2,
                                height: viewportHeight / 2,
                                type: "square"
                            },
                            boundary: {
                                width: containerWidth,
                                height: viewportHeight / 2
                            }
                        });
                    }
                }

                window.addEventListener("load", function() {
                    document.querySelectorAll("[data-ie-crop-close]").forEach(function(btn) {
                        btn.addEventListener("click", closeCrop);
                    });
                    var setBtn = document.querySelector("[data-ie-crop-set]");
                    if (setBtn) setBtn.addEventListener("click", getImage);

                    if (cropDialog) {
                        cropDialog.addEventListener("close", function() {});
                        // Re-bind after open when dialog is shown
                        var observer = new MutationObserver(function() {
                            if (cropDialog.open) {
                                window.setTimeout(bindCropper, 40);
                            }
                        });
                        observer.observe(cropDialog, { attributes: true, attributeFilter: ["open"] });
                    }

                    $(".image-crop").on("change", function() {
                        var input = this;
                        var reader = new FileReader();
                        selectedImage = {
                            element: $(input).attr("name") + "--iMage",
                            height: parseInt($(input).attr("height"), 10) || 300,
                            width: parseInt($(input).attr("width"), 10) || 300
                        };
                        reader.onload = function(e) {
                            openCrop();
                            window.setTimeout(function() {
                                bindCropper();
                                if ($image_crop) {
                                    $image_crop.croppie("bind", {
                                        url: e.target.result
                                    }).then(function() {
                                        isImageSelected = true;
                                    });
                                }
                            }, 180);
                        };
                        if (input.files && input.files[0]) reader.readAsDataURL(input.files[0]);
                    });
                });
            })();
        </script>
    </x-slot:scripts>
</x-layouts.site>
