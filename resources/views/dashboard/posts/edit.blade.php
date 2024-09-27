<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <form method="post" enctype="multipart/form-data" id="formToValidate" action="{{ route('dashboard.posts.edit.post', ['id' => $dataDetail->id]) }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.detail') }}</h4>
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
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('slug') text-danger @enderror">{{ __('dashboard.slug') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="slug"
                                            class="form-control text-dark ps-5 h-58 @error('slug') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('slug', $dataDetail->slug) }}"
                                            placeholder="{{ __('dashboard.slug') }}" required>
                                        <i class="ri-link position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('type') text-danger @enderror">{{ __('dashboard.type') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" name="type" aria-label="Parent category selection" required>
                                            <option class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.type') }}</option>
                                            @foreach ($postTypes as $data)
                                                <option value="{{ $data }}" class="text-dark" @if ($data == old('type', $dataDetail->type)) selected="selected" @endif>{{ $data }}</option>
                                            @endforeach
                                        </select>
                                        <i
                                            class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.english') }}</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ URL::asset('/images/posts/'.$dataDetail->image) }}" class="img-thumbnail mb-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('title') text-danger @enderror">{{ __('dashboard.title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="title"
                                            class="form-control text-dark ps-5 h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('title', $dataDetail->title) }}"
                                            placeholder="{{ __('dashboard.title') }}" required>
                                        <i class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4" id="imageFormGroup">
                                    <label
                                        class="label @error('image') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                    <input type="file" class="form-control h-58" id="image" name="image"
                                        accept="image/*">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('day') text-danger @enderror">{{ __('dashboard.day') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="day"
                                                    class="form-control text-dark h-58 @error('day') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('day', $dataDetail->day) }}"
                                                    placeholder="{{ __('dashboard.day') }}">
                                            </div>
                                            @error('day')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('month') text-danger @enderror">{{ __('dashboard.month') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="month"
                                                    class="form-control text-dark h-58 @error('month') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('month', $dataDetail->month) }}"
                                                    placeholder="{{ __('dashboard.month') }}">
                                            </div>
                                            @error('month')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('year') text-danger @enderror">{{ __('dashboard.year') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="year"
                                                    class="form-control text-dark h-58 @error('year') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('year', $dataDetail->year) }}"
                                                    placeholder="{{ __('dashboard.year') }}">
                                            </div>
                                            @error('year')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('description') text-danger @enderror">{{ __('dashboard.description') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="description" name="description"
                                            class="form-control text-dark @error('description') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.description') }}" rows="3" rows="7">{{ old('description', $dataDetail->description) }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.gujarati') }}</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ URL::asset('/images/posts/'.$dataDetail->image_g) }}" class="img-thumbnail mb-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('title_g') text-danger @enderror">{{ __('dashboard.title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="title_g"
                                            class="form-control text-dark ps-5 h-58 @error('title_g') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('title_g', $dataDetail->title_g) }}"
                                            placeholder="{{ __('dashboard.title') }}">
                                        <i class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('title_g')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4" id="imageFormGroup">
                                    <label
                                        class="label @error('image_g') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                    <input type="file" class="form-control h-58" id="image_g" name="image_g"
                                        accept="image/*">
                                    @error('image_g')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('day_g') text-danger @enderror">{{ __('dashboard.day') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="day_g"
                                                    class="form-control text-dark h-58 @error('day_g') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('day_g', $dataDetail->day_g) }}"
                                                    placeholder="{{ __('dashboard.day') }}">
                                            </div>
                                            @error('day_g')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('month_g') text-danger @enderror">{{ __('dashboard.month') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="month_g"
                                                    class="form-control text-dark h-58 @error('month_g') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('month_g', $dataDetail->month_g) }}"
                                                    placeholder="{{ __('dashboard.month') }}">
                                            </div>
                                            @error('month_g')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('year_g') text-danger @enderror">{{ __('dashboard.year') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="year_g"
                                                    class="form-control text-dark h-58 @error('year_g') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('year_g', $dataDetail->year_g) }}"
                                                    placeholder="{{ __('dashboard.year') }}">
                                            </div>
                                            @error('year_g')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('description_g') text-danger @enderror">{{ __('dashboard.description') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="description_g" name="description_g"
                                            class="form-control text-dark @error('description_g') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.description') }}" rows="3" rows="7">{{ old('description_g', $dataDetail->description_g) }}</textarea>
                                    </div>
                                    @error('description_g')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.hindi') }}</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ URL::asset('/images/posts/'.$dataDetail->image_h) }}" class="img-thumbnail mb-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('title_h') text-danger @enderror">{{ __('dashboard.title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="title_h"
                                            class="form-control text-dark ps-5 h-58 @error('title_h') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('title_h', $dataDetail->title_h) }}"
                                            placeholder="{{ __('dashboard.title') }}">
                                        <i class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('title_h')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4" id="imageFormGroup">
                                    <label
                                        class="label @error('image_h') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                    <input type="file" class="form-control h-58" id="image_h" name="image_h"
                                        accept="image/*">
                                    @error('image_h')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('day_h') text-danger @enderror">{{ __('dashboard.day') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="day_h"
                                                    class="form-control text-dark h-58 @error('day_h') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('day_h', $dataDetail->day_h) }}"
                                                    placeholder="{{ __('dashboard.day') }}">
                                            </div>
                                            @error('day_h')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('month_h') text-danger @enderror">{{ __('dashboard.month') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="month_h"
                                                    class="form-control text-dark h-58 @error('month_h') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('month_h', $dataDetail->month_h) }}"
                                                    placeholder="{{ __('dashboard.month') }}">
                                            </div>
                                            @error('month_h')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-4">
                                            <label
                                                class="label @error('year_h') text-danger @enderror">{{ __('dashboard.year') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="year_h"
                                                    class="form-control text-dark h-58 @error('year_h') border border-danger rounded-3 border-3 @enderror"
                                                    data-pristine-pattern="/[a-z]+$/i"
                                                    value="{{ old('year_h', $dataDetail->year_h) }}"
                                                    placeholder="{{ __('dashboard.year') }}">
                                            </div>
                                            @error('year_h')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('description_h') text-danger @enderror">{{ __('dashboard.description') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="description_h" name="description_h"
                                            class="form-control text-dark @error('description_h') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.description') }}" rows="3" rows="7">{{ old('description_h', $dataDetail->description_h) }}</textarea>
                                    </div>
                                    @error('description_h')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('extra') text-danger @enderror">{{ __('dashboard.extra') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="extra" name="extra"
                                            class="form-control text-dark @error('extra') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.extra') }}" rows="3" rows="7">{{ old('extra', $dataDetail->extra) }}</textarea>
                                    </div>
                                    @error('extra')
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
