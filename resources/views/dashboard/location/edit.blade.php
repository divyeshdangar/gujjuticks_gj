<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <style>
        .cr-boundary {
            border-radius: 15px;
        }
    </style>

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">{{ __('dashboard.location') }}</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>{{ __('dashboard.home') }}</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">{{ __('dashboard.location') }}</span>
            </li>
        </ul>
    </div>

    <form method="post" id="formToValidate" action="{{ route('dashboard.location.edit.post', ['id' => $dataDetail->id]) }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-8">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.location') }}</h4>
                        @if ($errors->any())
                            <div class="text-danger border border-danger border-4 p-3 rounded-3 mb-3">
                                <b>{{ __('dashboard.error') }}:</b>
                                <hr>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('title') text-danger @enderror">{{ __('dashboard.title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="title"
                                            class="form-control text-dark ps-5 h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('title', $dataDetail->title) }}"
                                            placeholder="{{ __('dashboard.title') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('name') text-danger @enderror">{{ __('dashboard.name') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="name"
                                            class="form-control text-dark ps-5 h-58 @error('name') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('name', $dataDetail->name) }}"
                                            placeholder="{{ __('dashboard.name') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('name_gj') text-danger @enderror">{{ __('dashboard.name_gj') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="name_gj"
                                            class="form-control text-dark ps-5 h-58 @error('name_gj') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('name_gj', $dataDetail->name_gj) }}"
                                            placeholder="{{ __('dashboard.name_gj') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('name_gj')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('slug') text-danger @enderror">{{ __('dashboard.slug') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="slug"
                                            class="form-control text-dark ps-5 h-58 @error('slug') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('slug', $dataDetail->slug) }}"
                                            placeholder="{{ __('dashboard.slug') }}" required>
                                        <i
                                            class="ri-link position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4" id="imageFormGroup">
                                    <label
                                        class="label @error('slug') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*">
                                    <input type="hidden" id="croppedImage" name="croppedImage" value="">
                                </div>
                                <div id="upload-image-image"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('meta_description') text-danger @enderror">{{ __('dashboard.meta_description') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="meta_description" name="meta_description"
                                            class="form-control text-dark @error('meta_description') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.meta_description') }}" rows="3" rows="7" required>{{ old('meta_description', $dataDetail->meta_description) }}</textarea>
                                    </div>
                                    @error('meta_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('keywords') text-danger @enderror">{{ __('dashboard.meta_keywords') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="keywords" name="keywords"
                                            class="form-control text-dark @error('keywords') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.keywords') }}" rows="3" rows="7" required>{{ old('keywords', $dataDetail->keywords) }}</textarea>
                                    </div>
                                    @error('keywords')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('description') text-danger @enderror">{{ __('dashboard.description') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="description" name="description"
                                            class="form-control text-dark ckeditor5  @error('description') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.description') }}" cols="30" rows="7">{{ old('description', $dataDetail->description) }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('description_gj') text-danger @enderror">{{ __('dashboard.description_gj') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="description_gj" name="description_gj"
                                            class="form-control text-dark ckeditor5  @error('description_gj') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.description_gj') }}" cols="30" rows="7">{{ old('description_gj', $dataDetail->description_gj) }}</textarea>
                                    </div>
                                    @error('description_gj')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('latitude') text-danger @enderror">{{ __('dashboard.latitude') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="latitude"
                                            class="form-control text-dark ps-5 h-58 @error('latitude') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('latitude', $dataDetail->latitude) }}"
                                            placeholder="{{ __('dashboard.latitude') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('latitude')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('longitude') text-danger @enderror">{{ __('dashboard.longitude') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="longitude"
                                            class="form-control text-dark ps-5 h-58 @error('longitude') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('longitude', $dataDetail->longitude) }}"
                                            placeholder="{{ __('dashboard.longitude') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('longitude')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group d-flex gap-3">
                                    <button
                                        class="btn btn-primary py-3 px-5 fw-semibold text-white">{{ __('dashboard.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.location') }} {{ __('dashboard.image') }}</h4>
                        <img src="{{ URL::asset('/images/cities/'.$dataDetail->image) }}" class="img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        var $image_crop;
        var $banner_crop;
        var isImageSelected = false;
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
                    width: 192,
                    height: 108,
                    type: 'square'
                },
                boundary: {
                    width: $("#imageFormGroup").width(),
                    height: $("#imageFormGroup").width() / 2
                },
                //url: '{{ URL::asset('/images/location/' . $dataDetail->image) }}'
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

</x-layouts.dashboard>
