<x-layouts.front :showHeader="true" :metaData="$metaData">
    <style>
        .cr-boundary {
            border-radius: 15px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>


    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Boost your professional image</h6>
                        <h1 class="display-5 fw-semibold mb-3">{{ $dataDetail->title }}</h1>
                        <p class="lead text-muted mb-4">{{ $dataDetail->meta_description }}</p>

                        <lable class="text-muted">Caption</lable>
                        <p class="text-muted mb-0 p-3 border border-3 rounded-4">{!! $dataDetail->caption !!}</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-md-0">
                        <img loading="lazy" src="{{ route('pages.image.postmain', ['slug' => $dataDetail->slug . '.jpg']) }}"
                            alt="" class="home-img w-100 rounded-4" alt="{{ $dataDetail->title }}"
                            title="{{ $dataDetail->title }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center align-items-center">

                @if(Auth::check())
                    <div class="col-lg-5">
                        <div class="section-title mb-5">
                            <h3 class="title text-warning">Manage and Update Your Post Content</h3>
                            <p class="text-muted">Use the tools below to edit your post sets and individual posts with ease. Update titles, descriptions, or visual elements to keep your content fresh, relevant, and aligned with your brand. Whether you're refining a draft or improving live posts, this panel puts full control in your hands.</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <form method="post" enctype="multipart/form-data" action="{{ route('pages.postset.business.add') }}" class="contact-form mt-4" name="basicDetailsForm"
                            id="basicDetailsForm">
                            {{ csrf_field() }}
                            <span id="error-msg">
                                @if ($errors->any())
                                    <div class="text-danger border border-danger border-2 p-3 rounded-3 mb-3">
                                        <b>{{ __('dashboard.error') }}:</b>
                                        <hr>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </span>
                            <div class="mb-3">
                                <label for="instagram"
                                    class="form-label @error('instagram') text-danger @enderror">Instagram Username</label>
                                <input type="text" value="{{ old('instagram', ($bProfile ? $bProfile->instagram : '')) }}" maxlength="64" name="instagram"
                                    id="instagram"
                                    class="form-control @error('instagram') border border-danger border-1 @enderror" required>
                                @error('instagram')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3" id="imageFormGroup">
                                <label for="image" class="form-label @error('image') text-danger @enderror">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') border border-danger border-1 @enderror">
                                <input type="hidden" id="croppedImage" name="croppedImage" value="">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="upload-image-image"></div>
                            <button type="submit" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Save</button>
                        </form>
                    </div>
                @else
                    <div class="col-lg-8">
                        <div class="section-title">
                            <h3 class="title text-warning text-center">🔒 Login to Unlock Personalization ✨</h3>
                            <ul class="text-muted">
                                <li>Want to add your logo, update your contact info, or customize posts with your brand? 🖼️📱🔧</li>
                                <li>Login to access your personal dashboard and make it your own! 💼🎨</li>
                                <li>It only takes a moment to get started — and your brand will shine in every post you share. 🌟💬</li>
                            </ul>
                        </div>
                        <div class="mt-3 text-center">
                            <a class="btn btn-warning" href="{{ route('login') }}" style="color: rgb(19, 19, 19) !important;">🔑 Login Now</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-4">
                    <div class="section-title mb-5">
                        <h3 class="title text-warning">Discover Curated Visual Stories</h3>
                        <p class="text-muted">Explore a growing collection of creative posts covering history, culture,
                            lifestyle, and more. Each set is uniquely crafted with engaging content and dynamic visuals,
                            designed to inform, inspire, and spark curiosity. Dive into the stories that matter - one
                            post at a time.</p>
                    </div>
                </div>
                @if ($dataDetail && $dataDetail->posts && count($dataDetail->posts) > 0)
                    @foreach ($dataDetail->posts as $key => $value)
                        <div class="col-lg-4 mb-4">
                            <img loading="lazy" src="{{ route('pages.image.postset', ['slug' => $value->slug . '.jpg']) }}"
                                class="rounded-4 w-100 mb-3" alt="{{ $value->title }}" title="{{ $value->title }}">
                            <h3 class="h4">{{ $value->title }}</h3>
                            <p class="text-muted">{{ $value->description }}</p>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>
    </section>

    <script>
        var $image_crop;
        var $banner_crop;
        var isImageSelected = false;
        window.addEventListener('load', function(event) {
            addCropperImage();
            $("#basicDetailsForm").submit(function(eventObj) {
                getImage();
                return true;
            });
        });

        function getImage() {
            $('#upload-image-image').croppie('result', {
                type: 'base64',
                format: 'png',
                size: { width: 255, height: 75 }
                //quality: 0.7
            }).then(function(resp) {
                if (resp && isImageSelected) {
                    $("#croppedImage").val(resp)
                } else {
                    $("#croppedImage").val("")
                }
            });
        }

        function addCropperImage() {
            $image_crop = $('#upload-image-image').croppie({
                //enableExif: true,
                enableResize: true,
                viewport: {
                    width: 255,
                    height: 75,
                    type: 'square'
                },
                boundary: {
                    width: $("#imageFormGroup").width(),
                    height: 150
                },
                @if($bProfile && !empty($bProfile->logo))
                    url: '{{ URL::asset('/images/business/logo/' . $bProfile->logo) }}'
                @endif
            });
            $('#image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        isImageSelected = true;
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });
        }
    </script>
</x-layouts.front>
