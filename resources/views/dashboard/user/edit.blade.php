<x-layouts.dashboard-layout :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-lg-9">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.user') }}</h4>
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

                    <form method="post" id="formToValidate"
                        action="{{ route('dashboard.blog.edit.post', ['id' => $dataDetail->id]) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div
                                    class="form-group mb-4 p-4 bg-border-gray-light d-sm-flex justify-content-between align-items-center rounded-10">
                                    <div class="d-sm-flex align-items-center mb-3 mb-sm-0 me-lg-3">
                                        <div class="me-md-5 pe-xxl-5 mb-3 mb-sm-0">
                                            <h4 class="body-font fs-15 fw-semibold text-body">
                                                {{ __('dashboard.your_photo') }}</h4>
                                            <p>{{ __('dashboard.your_photo_msg') }}</p>
                                        </div>
                                        <img src="{{ auth()->user()->profile }}"
                                            class="rounded-4 wh-78 ms-3 ms-lg-0 rounded-circle" alt="product">
                                    </div>

                                    <div class="d-flex ms-sm-3 ms-md-0">
                                        <button type="button"
                                            class="btn bg-danger bg-opacity-10 text-danger fw-semibold">{{ __('dashboard.delete') }}</button>
                                        <button type="button"
                                            class="btn bg-primary bg-opacity-10 text-primary fw-semibold ms-3">{{ __('dashboard.update') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('first_name') text-danger @enderror">{{ __('dashboard.first_name') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="first_name"
                                            class="form-control text-dark ps-5 h-58 @error('first_name') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('first_name', $dataDetail->first_name) }}"
                                            placeholder="{{ __('dashboard.first_name') }}" readonly>
                                        <i
                                            class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('last_name') text-danger @enderror">{{ __('dashboard.last_name') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="last_name"
                                            class="form-control text-dark ps-5 h-58 @error('last_name') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('last_name', $dataDetail->last_name) }}"
                                            placeholder="{{ __('dashboard.last_name') }}" readonly>
                                        <i
                                            class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('email') text-danger @enderror">{{ __('dashboard.email') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="email" name="email"
                                            class="form-control text-dark ps-5 h-58 @error('email') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('email', $dataDetail->email) }}"
                                            placeholder="{{ __('dashboard.email') }}" readonly>
                                        <i
                                            class="ri-mail-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('phone') text-danger @enderror">{{ __('dashboard.phone') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="tel" id="phone" name="phone" maxlength="10"
                                            class="form-control text-dark ps-5 h-58 @error('phone') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('phone', $dataDetail->phone) }}"
                                            placeholder="{{ __('dashboard.phone') }}" required>
                                        <i
                                            class="ri-phone-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('bio') text-danger @enderror">{{ __('dashboard.bio') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="bio" name="bio"
                                            class="form-control ps-5 text-dark @error('bio') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.bio') }}" cols="30" rows="5" required>{{ old('bio', $dataDetail->bio) }}</textarea>
                                        <i
                                            class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                    </div>
                                    @error('bio')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('username') text-danger @enderror">{{ __('dashboard.username') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" id="username" name="username"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            class="form-control text-dark ps-5 h-58 @error('username') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('username', $dataDetail->username) }}"
                                            placeholder="{{ __('dashboard.username') }}" required>
                                        <i
                                            class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('username')
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
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.user') }}</h4>
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

                    <form method="post" id="formToValidate" action="{{ route('dashboard.user.access', ['id' => $dataDetail->id]) }}">
                        {{ csrf_field() }}
                        <ul class="list-group">
                            @php
                                $userMenus = !empty($dataDetail->menus) ? (strlen($dataDetail->menus->menuIds) > 0 ? explode(",", $dataDetail->menus->menuIds) : []) : [];
                            @endphp
                            @foreach ($menuList as $menu)
                                <li class="list-group-item bg-white">
                                    <input class="form-check-input me-1" 
                                        @if(in_array($menu->id, $userMenus)) {{ 'checked' }} @endif
                                        type="checkbox" name="menuIds[]" value="{{ $menu->id }}" id="menu_{{ $menu->id }}">
                                    <label class="form-check-label" for="menu_{{ $menu->id }}">{{ __($menu->title) }}</label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="form-group d-flex gap-3">
                            <button type="submit" class="btn btn-primary fw-semibold text-white py-2 px-4 mt-3 me-2">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>
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

</x-layouts.dashboard-layout>