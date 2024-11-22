<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom text-muted pb-20 mb-20">https://gujju.me/<span class="text-primary">{{ $dataDetail->link }}</span></h4>
                    <div class="tab-pane fade show active" id="preview3-tab-pane" role="tabpanel"
                        aria-labelledby="preview3-tab" tabindex="0">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-basic-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-basic" type="button" role="tab"
                                    aria-controls="pills-basic" aria-selected="true">Basic Info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-links-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-links" type="button" role="tab"
                                    aria-controls="pills-links" aria-selected="false">Links</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-products-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-products" type="button" role="tab"
                                    aria-controls="pills-products" aria-selected="false">Products</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-templates-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-templates" type="button" role="tab"
                                    aria-controls="pills-templates" aria-selected="false">Template</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-settings" type="button" role="tab"
                                    aria-controls="pills-settings" aria-selected="false">Settings</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-basic" role="tabpanel"
                                aria-labelledby="pills-basic-tab" tabindex="0">
                                <div class="bg-light px-2 py-3 rounded">
                                    Basic
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-links" role="tabpanel"
                                aria-labelledby="pills-links-tab" tabindex="0">
                                
                                <div class="py-2">
                                    <div class="accordion accordion-flush faq-wrapper" id="accordionFlushExample3">
                                        <div class="accordion-item border-0 rounded mb-3">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed fs-16 fw-semibold text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1" aria-expanded="false" aria-controls="flush-collapseOne1">
                                                    Dynamically procrastinate B2C users after installed.
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample3">
                                                <div class="accordion-body pt-1">Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. An utinam consulatu eos, est facilis.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0 mb-3">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed fs-16 fw-semibold text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo2" aria-expanded="false" aria-controls="flush-collapseTwo2">
                                                    Efficiently unleash cross-media information without cross-media value.
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample3">
                                                <div class="accordion-body pt-1">Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. An utinam consulatu eos, est facilis.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0 mb-3">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed fs-16 fw-semibold text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree3" aria-expanded="false" aria-controls="flush-collapseThree3">
                                                    Relationships via premier niche markets.
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample3">
                                                <div class="accordion-body pt-1">Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. An utinam consulatu eos, est facilis.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0 mb-3">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed fs-16 fw-semibold text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive5" aria-expanded="false" aria-controls="flush-collapseFive5">
                                                    It has roots in a piece of classical
                                                </button>
                                            </h2>
                                            <div id="flush-collapseFive5" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample3">
                                                <div class="accordion-body pt-1">Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. An utinam consulatu eos, est facilis.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0 mb-0">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed fs-16 fw-semibold text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix6" aria-expanded="false" aria-controls="flush-collapseSix6">
                                                    Sed do eiusmod tempor incididunt dolore magna.
                                                </button>
                                            </h2>
                                            <div id="flush-collapseSix6" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample3">
                                                <div class="accordion-body pt-1">Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. An utinam consulatu eos, est facilis.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pills-products" role="tabpanel"
                                aria-labelledby="pills-products-tab" tabindex="0">
                                <p>
                                    Products
                                </p>
                            </div>
                            <div class="tab-pane fade" id="pills-templates" role="tabpanel"
                                aria-labelledby="pills-templates-tab" tabindex="0">
                                <p>
                                    Templates
                                </p>
                            </div>
                            <div class="tab-pane fade" id="pills-settings" role="tabpanel"
                                aria-labelledby="pills-settings-tab" tabindex="0">
                                <p>
                                    Settings
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.user') }}</h4>

                </div>
            </div>
        </div>
    </div>

    <script>
        var $image_crop;
        window.addEventListener('load', function(event) {
            addCropperImage();
            $("#formToValidate").submit(function(eventObj) {
                getImage();
                return true;
            });
        });

        function getImage() {
            $('#upload-image-image').croppie('result', {
                type: 'base64',
                format: 'jpeg',
                quality: 0.7
            }).then(function(resp) {
                if (resp) {
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
                    width: 240,
                    height: 80,
                    type: 'square'
                },
                boundary: {
                    width: $("#imageFormGroup").width(),
                    height: $("#imageFormGroup").width() / 2
                },
                url: '{{ URL::asset('/images/blog/' . $dataDetail->image) }}'
            });
            $('#image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });
        }
    </script>

</x-layouts.dashboard>
