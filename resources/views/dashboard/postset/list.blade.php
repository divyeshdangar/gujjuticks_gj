<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    <script type="text/javascript" src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.postset') }}
                {{ __('dashboard.list') }}</h4>
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

            <form method="post" enctype="multipart/form-data" id="imageItemRepeater">
                {{ csrf_field() }}
                <div class="row" data-repeater-list="imageItems">

                    <div class="col-md-12">
                        <button type="button" data-repeater-create class="btn btn-sm btn-primary mb-2">Add Skill</button>
                    </div>

                    @foreach ($itemData as $key => $value)
                        <div class="col-lg-12" data-repeater-item>
                            <div class="row py-3 border-bottom border-3">
                                <div class="col-md-4">
                                    <img src="{{ route('pages.image.postset', ['slug' => $value->slug . '.jpg']) }}"
                                        class="rounded-4 border border-dark border-2">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ $value->title }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3">{{ $value->description }}</textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label">{{ __('dashboard.image') }}</label>
                                        <div class="form-group position-relative">
                                            <select class="form-select form-control" name="image_id"
                                                required aria-label="Parent category selection">
                                                <option value="" class="text-dark">{{ __('dashboard.select') }}
                                                    {{ __('dashboard.image') }}</option>
                                                @foreach ($imageData as $data)
                                                    <option value="{{ $data->id }}" class="text-dark"
                                                        @if ($data->id == old('image_id', $dataDetail->image_id)) selected="selected" @endif>
                                                        {{ $data->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" data-repeater-delete
                                        class="btn btn-sm btn-outline-danger mt-2" required>Remove</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-4">
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

    <script>
        $('#imageItemRepeater').repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                if (confirm('Remove this item entry?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    </script>
</x-layouts.dashboard>
