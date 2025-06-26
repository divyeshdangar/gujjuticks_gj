<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <style>
        .cr-boundary {
            border-radius: 15px;
        }
    </style>

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <form method="post" id="formToValidate" action="{{ route('dashboard.image.edit.post', ['id' => $dataDetail->id]) }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body">
                        <img src="{{ route('pages.image.detail', ['slug' => $dataDetail->slug]) }}"
                            class="img-fluid rounded">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.image') }}</h4>
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
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('type') text-danger @enderror">{{ __('dashboard.type') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" name="type"
                                            aria-label="Parent category selection">
                                            <option class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.type') }}</option>

                                            @foreach ($dataDetail->getTypes() as $key => $data)
                                                <option value="{{ $key }}" class="text-dark"
                                                    @if ($key == old('type', $dataDetail->type)) selected="selected" @endif>
                                                    {{ $data }}</option>
                                            @endforeach
                                        </select>
                                        <i
                                            class="ri-flag-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('bg_color') text-danger @enderror">{{ __('dashboard.bg_color') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="color" name="bg_color"
                                            class="form-control text-dark ps-5 h-58 @error('bg_color') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('bg_color', $dataDetail->bg_color) }}"
                                            placeholder="{{ __('dashboard.bg_color') }}" required>
                                        <i
                                            class="ri-link position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('bg_color')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('colors') text-danger @enderror">{{ __('dashboard.colors') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="colors"
                                            class="form-control text-dark ps-5 h-58 @error('colors') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('colors', $dataDetail->colors) }}"
                                            placeholder="{{ __('dashboard.colors') }}" required>
                                        <i
                                            class="ri-link position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('colors')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4" id="imageFormGroup">
                                    <label
                                        class="label @error('image') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                    <input type="file" class="form-control h-58" id="image" name="image"
                                        accept="image/*">
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('height') text-danger @enderror">{{ __('dashboard.height') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="height"
                                            class="form-control text-dark ps-5 h-58 @error('height') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('height', $dataDetail->height) }}"
                                            placeholder="{{ __('dashboard.height') }}" required>
                                        <i
                                            class="ri-link position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('height')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('width') text-danger @enderror">{{ __('dashboard.width') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="width"
                                            class="form-control text-dark ps-5 h-58 @error('width') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('width', $dataDetail->width) }}"
                                            placeholder="{{ __('dashboard.width') }}" required>
                                        <i
                                            class="ri-link position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('width')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('image_title') text-danger @enderror">{{ __('dashboard.image_title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="image_title"
                                            class="form-control text-dark ps-5 h-58 @error('image_title') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('image_title', $dataDetail->image_title) }}"
                                            placeholder="{{ __('dashboard.image_title') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('image_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('image_alt') text-danger @enderror">{{ __('dashboard.image_alt') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="image_alt"
                                            class="form-control text-dark ps-5 h-58 @error('image_alt') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('image_alt', $dataDetail->image_alt) }}"
                                            placeholder="{{ __('dashboard.image_alt') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('image_alt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('keywords') text-danger @enderror">{{ __('dashboard.keywords') }}</label>
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
        </div>
    </form>

</x-layouts.dashboard>
