<x-layouts.front :showHeader="true" :metaData="$metaData">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    <script type="text/javascript" src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>

    <style>
        .locked {
            pointer-events: none;
        }
        #upload-image-image {
            width: 100%;
            max-width: 670px;
            height: auto;
            margin: 0 auto;
        }
    </style>


    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Create Image Easily</h6>
                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'Jamnagar Nursing Parivar',
                            '<span class="text-info fw-bold">Jamnagar Nursing Parivar</span>',
                            $dataDetail->title,
                        ) !!}</h1>
                        <p class="lead text-muted mb-0">{{ $dataDetail->meta_description }}</p>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0 h-100">
                                <button class="btn btn-info" style="color: rgb(19, 19, 19) !important;"
                                    data-bs-toggle="modal" data-bs-target="#startBuildingResume">Create Image
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img src="{{ asset('images/dynamic/' . $dataDetail->image) }}"
                            title="{{ $dataDetail->image_title }}" alt="{{ $dataDetail->image_alt }}"
                            class="rounded home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Create Your Image</h2>
                        <p class="text-muted mb-5">This tool lets you quickly generate a personalized image using a
                            ready-made template. Just fill in a few details—no design skills needed—and get a
                            professional image in seconds.</p>
                        <div class="row text-start">
                            <div class="col-lg-8">
                                @if ($dataDetail->data)
                                    <div class="row">
                                        @foreach ($dataDetail->data as $key => $value)
                                            @if ($value->is_editable)
                                                @if ($value->type == 'text')
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="{{ $value->random_identity }}"
                                                                class="form-label">{{ $value->form_title }}</label>
                                                            <input type="text" value="{{ $value->text }}"
                                                                name="{{ $value->random_identity }}"
                                                                id="{{ $value->random_identity }}"
                                                                class="form-control mb-1">
                                                            <small>{{ $value->form_description }}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($value->type == 'paragraph')
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="{{ $value->random_identity }}"
                                                                class="form-label">{{ $value->form_title }}</label>
                                                            <textarea name="{{ $value->random_identity }}" id="{{ $value->random_identity }}" class="form-control mb-1"
                                                                rows="5">{{ $value->text }}</textarea>
                                                            <small>{{ $value->form_description }}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($value->type == 'image')
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="{{ $value->random_identity }}"
                                                                class="form-label">{{ $value->form_title }}</label>
                                                            <input type="file" name="{{ $value->random_identity }}"
                                                                id="{{ $value->random_identity }}"
                                                                class="form-control mb-1 image-crop">
                                                            <small>{{ $value->form_description }}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <div class="mt-5 mt-md-0">
                                    <img src="{{ route('pages.image.detail', ['slug' => $dataDetail->slug]) }}"
                                        title="{{ $dataDetail->image_title }}" alt="{{ $dataDetail->image_alt }}"
                                        class="rounded home-img w-100" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <button class="btn btn-warning btn-hover" style="color: rgb(19, 19, 19) !important;"
                                data-bs-toggle="modal" data-bs-target="#startBuildingResume">Create Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title me-5">
                        <h3 class="title text-info">How It Work</h3>
                        <p class="text-muted">Post a job to tell us about your project. We'll quickly match you with the
                            right freelancers.</p>
                        <div class="process-menu nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0">
                                        1
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Fill In Your Details</h5>
                                        <p class="text-muted mb-0">Enter the required information in our simple
                                            form—like name, title, message, or location—depending on the image. The form
                                            is tailored for this specific template, so it’s quick and easy.</p>
                                    </div>
                                </div>
                            </a>
                            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0">
                                        2
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">We Generate the Image Automatically</h5>
                                        <p class="text-muted mb-0">Once you submit the form, we instantly place your
                                            data into a pre-designed image template. No design skills needed—everything
                                            is handled behind the scenes.</p>
                                    </div>
                                </div>
                            </a>
                            <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                aria-selected="false">
                                <div class=" d-flex">
                                    <div class="number flex-shrink-0">
                                        3
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Download or Share the Image</h5>
                                        <p class="text-muted mb-0">Preview your personalized image and download it in
                                            high quality. It's ready to post, print, or share on social media right
                                            away.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <img src="{{ asset('files/images/fill-in-details.png') }}" alt=""
                                class="img-fluid">
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <img src="{{ asset('files/images/generate-the-image.png') }}" alt=""
                                class="img-fluid">
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <img src="{{ asset('files/images/download-and-share-image.png') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>







    <button id="modalButton" type="button" class="btn btn-primary text-white py-2 px-4 fw-semibold"
        data-bs-toggle="modal" data-bs-target="#cropperModal">
        Open Cropper
    </button>
    <div class="modal fade" id="cropperModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cropperModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cropperModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="canvasContainer">
                    <div id="upload-image-image"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger text-white"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary text-white" onclick="getImage()">Set
                        Image</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var $image_crop;
        var containerWidth;
        var viewportHeight;
        window.addEventListener('load', function(event) {
            addCropperImage();

            var cropImageModal = document.getElementById('cropperModal');
            cropImageModal.addEventListener('shown.bs.modal', function() {
                bindCropper()
            });

            cropImageModal.addEventListener('hidden.bs.modal', function() {
            });

        });

        function getImage() {
            $('#upload-image-image').croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {
                    width: 670,
                    height: 671
                }, // Fixed result size
                quality: 0.7
            }).then(function(resp) {
                if (resp && isImageSelected) {
                    setTimeout(() => {
                        console.log(resp);
                        openClick('modalButton');
                    }, 200);
                }
            });
        }

        function bindCropper() {
            containerWidth = document.getElementById('upload-image-image').offsetWidth;
            viewportHeight = (containerWidth / 670) * 671; // Scale height based on width

            if (!$image_crop) {
                $image_crop = $('#upload-image-image').croppie({
                    //enableExif: true,
                    enableResize: true,
                    viewport: {
                        width: containerWidth, // Dynamic based on container width
                        height: viewportHeight, // Calculated to maintain 9:16 aspect ratio
                        type: 'square' // You can change this to 'circle' or 'square' as per needs
                    },
                    boundary: {
                        width: containerWidth, // Set boundary equal to container width
                        height: viewportHeight // Same height as viewport to match 9:16 ratio
                    },
                    url: 'https://www.gujjuticks.com/images/dynamic/1727962910-1175287700.png'
                });
            }
        }

        function addCropperImage() {
            $('.image-crop').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    openClick('modalButton');
                    setTimeout(() => {
                        $image_crop.croppie('bind', {
                            url: e.target.result
                        }).then(function() {
                            isImageSelected = true;
                        });
                    }, 500);
                }
                reader.readAsDataURL(this.files[0]);
            });
        }

        function openClick(id) {
            var ele = document.getElementById(id);
            if (typeof ele.click == 'function') {
                ele.click()
            } else if (typeof ele.onclick == 'function') {
                ele.onclick()
            }
        }
    </script>
</x-layouts.front>
