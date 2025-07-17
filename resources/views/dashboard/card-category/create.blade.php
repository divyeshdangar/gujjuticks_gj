<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <style>
        .cr-boundary {
            border-radius: 15px;
        }
    </style>

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.card_category') }} {{ __('dashboard.edit') }}</h4>
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

                    <form method="post" id="formToValidate" enctype="multipart/form-data" action="{{ route('dashboard.card.category.edit.post', ['id' => '0']) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('name') text-danger @enderror">{{ __('dashboard.name') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="name"
                                            class="form-control text-dark h-58 @error('name') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('name') }}"
                                            placeholder="{{ __('dashboard.name') }}" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('slug') text-danger @enderror">{{ __('dashboard.slug') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="slug"
                                            class="form-control text-dark h-58 @error('slug') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('slug') }}"
                                            placeholder="{{ __('dashboard.slug') }}" required>
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4" id="imageFormGroup">
                                    <label class="label @error('slug') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                    <input type="file" class="form-control h-58" id="image" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('meta_description') text-danger @enderror">{{ __('dashboard.meta_description') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="meta_description" name="meta_description"
                                            class="form-control text-dark @error('meta_description') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.meta_description') }}" rows="3" rows="7" required>{{ old('meta_description') }}</textarea>
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
                                            placeholder="{{ __('dashboard.description') }}">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
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
                                            placeholder="{{ __('dashboard.keywords') }}" rows="3" rows="7" required>{{ old('keywords') }}</textarea>
                                    </div>
                                    @error('keywords')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('is_featured') text-danger @enderror">{{ __('dashboard.is_featured') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control h-58" name="is_featured"
                                            aria-label="Parent category selection">
                                            <option class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.is_featured') }}</option>

                                            @foreach ($dataDetail->getBool() as $key => $data)
                                                <option value="{{ $key }}" class="text-dark"
                                                    @if ($key == old('is_featured')) selected="selected" @endif>
                                                    {{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('is_featured')
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
    </div>
</x-layouts.dashboard>