<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <form method="post" id="formToValidate"
        action="{{ route('dashboard.image.data.edit.post', ['id' => $dataListDetail->id, 'image_id' => $dataDetail->id]) }}">
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
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('type') text-danger @enderror">{{ __('dashboard.type') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control h-58" name="type"
                                            aria-label="Parent category selection">
                                            <option class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.type') }}</option>

                                            @foreach ($dataListDetail->getTypes() as $key => $data)
                                                <option value="{{ $key }}" class="text-dark"
                                                    @if ($key == old('type', $dataListDetail->type)) selected="selected" @endif>
                                                    {{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('random_identity') text-danger @enderror">{{ __('dashboard.random_identity') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="random_identity"
                                            class="form-control text-dark h-58 @error('random_identity') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('random_identity', $dataListDetail->random_identity) }}"
                                            placeholder="{{ __('dashboard.random_identity') }}" required>
                                    </div>
                                    @error('random_identity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('list_order') text-danger @enderror">{{ __('dashboard.list_order') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="list_order"
                                            class="form-control text-dark h-58 @error('list_order') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('list_order', $dataListDetail->list_order) }}"
                                            placeholder="{{ __('dashboard.list_order') }}">
                                    </div>
                                    @error('list_order')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('opacity') text-danger @enderror">{{ __('dashboard.opacity') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="opacity"
                                            class="form-control text-dark h-58 @error('opacity') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('opacity', $dataListDetail->opacity) }}"
                                            placeholder="{{ __('dashboard.opacity') }}">
                                    </div>
                                    @error('opacity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('is_editable') text-danger @enderror">{{ __('dashboard.is_editable') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control h-58" name="is_editable"
                                            aria-label="Parent category selection">
                                            <option class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.is_editable') }}</option>
                                            <option value="1" class="text-dark"
                                                @if ('1' == old('is_editable', $dataListDetail->is_editable)) selected="selected" @endif>
                                                Yes
                                            </option>
                                            <option value="0" class="text-dark"
                                                @if ('0' == old('is_editable', $dataListDetail->is_editable)) selected="selected" @endif>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                    @error('is_editable')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix">
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('text') text-danger @enderror">{{ __('dashboard.text') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="text" name="text"
                                            class="form-control text-dark @error('text') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.text') }}" rows="3" rows="7">{{ old('text', $dataListDetail->text) }}</textarea>
                                    </div>
                                    @error('text')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('font') text-danger @enderror">{{ __('dashboard.font') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control h-58" name="font"
                                            aria-label="Parent category selection">
                                            <option value="" class="text-dark">{{ __('dashboard.font') }}
                                            </option>
                                            @foreach ($fontData as $data)
                                                <option value="{{ $data }}" class="text-dark"
                                                    @if ($data == old('font', $dataListDetail->font)) selected="selected" @endif>
                                                    {{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('font')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('font_size') text-danger @enderror">{{ __('dashboard.font_size') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="font_size"
                                            class="form-control text-dark h-58 @error('font_size') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('font_size', $dataListDetail->font_size) }}"
                                            placeholder="{{ __('dashboard.font_size') }}">
                                    </div>
                                    @error('font_size')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('text_color') text-danger @enderror">{{ __('dashboard.text_color') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="color" name="text_color"
                                            class="form-control text-dark h-58 @error('text_color') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('text_color', $dataListDetail->text_color) }}"
                                            placeholder="{{ __('dashboard.text_color') }}">
                                    </div>
                                    @error('text_color')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix">
                                <hr>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('text_align') text-danger @enderror">{{ __('dashboard.text_align') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control h-58" name="text_align"
                                            aria-label="Parent category selection">
                                            <option class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.text_align') }}</option>

                                            @foreach ($dataListDetail->getAligns() as $key => $data)
                                                <option value="{{ $key }}" class="text-dark"
                                                    @if ($key == old('text_align', $dataListDetail->text_align)) selected="selected" @endif>
                                                    {{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('text_align')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('left') text-danger @enderror">{{ __('dashboard.left') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="left"
                                            class="form-control text-dark h-58 @error('left') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('left', $dataListDetail->left) }}"
                                            placeholder="{{ __('dashboard.left') }}" required>
                                    </div>
                                    @error('left')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('text_align_v') text-danger @enderror">{{ __('dashboard.text_align_v') }}</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control h-58" name="text_align_v"
                                            aria-label="Parent category selection">
                                            <option class="text-dark">{{ __('dashboard.select') }}
                                                {{ __('dashboard.text_align_v') }}</option>

                                            @foreach ($dataListDetail->getAligns() as $key => $data)
                                                <option value="{{ $key }}" class="text-dark"
                                                    @if ($key == old('text_align_v', $dataListDetail->text_align_v)) selected="selected" @endif>
                                                    {{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('text_align_v')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('top') text-danger @enderror">{{ __('dashboard.top') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="top"
                                            class="form-control text-dark h-58 @error('top') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('top', $dataListDetail->top) }}"
                                            placeholder="{{ __('dashboard.top') }}" required>
                                    </div>
                                    @error('top')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('angle') text-danger @enderror">{{ __('dashboard.angle') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="angle"
                                            class="form-control text-dark h-58 @error('angle') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('angle', $dataListDetail->angle) }}"
                                            placeholder="{{ __('dashboard.angle') }}">
                                    </div>
                                    @error('angle')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix">
                                <hr>
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
                                        <input type="number" name="height" id="height"
                                            class="form-control text-dark h-58 @error('height') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('height', $dataListDetail->height) }}"
                                            placeholder="{{ __('dashboard.height') }}">
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
                                        <input type="number" name="width" id="width"
                                            class="form-control text-dark h-58 @error('width') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('width', $dataListDetail->width) }}"
                                            placeholder="{{ __('dashboard.width') }}">
                                    </div>
                                    @error('width')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix">
                                <hr>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('form_title') text-danger @enderror">{{ __('dashboard.form_title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="form_title"
                                            class="form-control text-dark h-58 @error('form_title') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('form_title', $dataListDetail->form_title) }}"
                                            placeholder="{{ __('dashboard.form_title') }}">
                                    </div>
                                    @error('form_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('form_description') text-danger @enderror">{{ __('dashboard.form_description') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="form_description"
                                            class="form-control text-dark h-58 @error('form_description') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('form_description', $dataListDetail->form_description) }}"
                                            placeholder="{{ __('dashboard.form_description') }}">
                                    </div>
                                    @error('form_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group d-flex gap-3">
                                    <button class="btn btn-primary py-3 px-5 fw-semibold text-white">{{ __('dashboard.save') }}</button>
                                    <a href="{{ route('dashboard.image.data.delete', ['id' => $dataListDetail->id, 'image_id' => $dataDetail->id]) }}" class="btn btn-danger py-3 px-5 fw-semibold text-white">{{ __('dashboard.delete') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            var _URL = window.URL || window.webkitURL;
            $("#image").change(function(e) {
                var file, img;
                if ((file = this.files[0])) {
                    img = new Image();
                    var objectUrl = _URL.createObjectURL(file);
                    img.onload = function() {
                        //alert(this.width + " " + this.height);

                        $("#width").val(this.width);
                        $("#height").val(this.height);

                        _URL.revokeObjectURL(objectUrl);
                    };
                    img.src = objectUrl;
                }
            });

            // $("#font").on("change", function() {
            //     var imageId = $(this).find(':selected').data('id');
            //     if (imageId > 0) {
            //         var iu = "<?php //echo base_url('ganerateimages/font/___.jpg'); ?>"
            //         $("#fontImage").attr("src", iu.replace("___", imageId));
            //     }
            // })
        });
    </script>
</x-layouts.dashboard>
