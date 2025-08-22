<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.postset') }}
                        {{ __('dashboard.edit') }}</h4>
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

                    <form method="post" id="formToValidate" enctype="multipart/form-data"
                        action="{{ route('dashboard.postset.edit.post', ['id' => $dataDetail->id]) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('title') text-danger @enderror">{{ __('dashboard.title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="title"
                                            class="form-control text-dark h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('title', $dataDetail->title) }}"
                                            placeholder="{{ __('dashboard.title') }}" required>
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('slug') text-danger @enderror">{{ __('dashboard.slug') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="slug"
                                            class="form-control text-dark h-58 @error('slug') border border-danger rounded-3 border-3 @enderror"
                                            data-pristine-pattern="/[a-z]+$/i"
                                            value="{{ old('slug', $dataDetail->slug) }}"
                                            placeholder="{{ __('dashboard.slug') }}" required>
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('slug') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                    <input type="file" class="form-control h-58" id="image" name="image"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('image_id') text-danger @enderror">{{ __('dashboard.category') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" name="image_id"
                                            required aria-label="Parent category selection">
                                            <option value="" class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.card_category') }}</option>
                                            @foreach ($imageData as $data)
                                                <option value="{{ $data->id }}" class="text-dark"
                                                    @if ($data->id == old('image_id', $dataDetail->image_id)) selected="selected" @endif>
                                                    {{ $data->title }}</option>
                                            @endforeach
                                        </select>
                                        <i
                                            class="ri-article-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('image_id')
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
                                        class="label @error('caption') text-danger @enderror">{{ __('dashboard.caption') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="caption" name="caption"
                                            class="form-control text-dark ckeditor5  @error('caption') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.caption') }}">{{ old('caption', $dataDetail->caption) }}</textarea>
                                    </div>
                                    @error('caption')
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
        <div class="col-lg-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.postset') }}
                        {{ __('dashboard.image') }}</h4>

                    <label class="label">{{ __('dashboard.image') }}</label>
                    <img src="{{ route('pages.image.postmain', ['slug' => $dataDetail->slug . '.jpg']) }}" class="img-thumbnail mb-4">
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
