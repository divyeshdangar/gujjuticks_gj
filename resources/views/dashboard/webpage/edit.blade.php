<x-layouts.dashboard :showHeader="true" :metaData="$metaData">
    <style>
        .cr-boundary {
            border-radius: 10px;
        }

        .w48 {
            display: inline-block;
            height: 48px;
            width: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom text-muted pb-20 mb-20">https://gujju.me/<span
                            class="text-primary">{{ $dataDetail->link }}</span></h4>
                    <div class="tab-pane fade show active" role="tabpanel" tabindex="0">
                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('dashboard.webpage.edit', ['id' => $dataDetail->id, 'section' => 'basic']) }}"
                                    class="nav-link @if ($section == 'basic') active @endif">Basic Info</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('dashboard.webpage.edit', ['id' => $dataDetail->id, 'section' => 'social']) }}"
                                    class="nav-link @if ($section == 'social') active @endif">Social</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('dashboard.webpage.edit', ['id' => $dataDetail->id, 'section' => 'links']) }}"
                                    class="nav-link @if ($section == 'links') active @endif">Links</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('dashboard.webpage.edit', ['id' => $dataDetail->id, 'section' => 'products']) }}"
                                    class="nav-link @if ($section == 'products') active @endif">Products</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('dashboard.webpage.edit', ['id' => $dataDetail->id, 'section' => 'template']) }}"
                                    class="nav-link @if ($section == 'template') active @endif">Template</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('dashboard.webpage.edit', ['id' => $dataDetail->id, 'section' => 'setting']) }}"
                                    class="nav-link @if ($section == 'setting') active @endif">Setting</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @switch($section)
                                @case('basic')
                                    <div class="tab-pane fade show active" role="tabpanel" tabindex="0">
                                        <div class="bg-body px-2 py-3 rounded">
                                            <form method="post" class="formToSubmit"
                                                action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="record_type" value="basic">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-4">
                                                            <label class="form-check-label text-danger" for="flexCheckDefault">
                                                                Important Note
                                                            </label><br>
                                                            <span class="text-muted">Careful to add details here as details will
                                                                be directly accessible to anyone with internet.</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="label">{{ __('dashboard.link') }}</label><br>
                                                            <div class="form-group position-relative">
                                                                <input type="text" name="link" maxlength="255"
                                                                    minlength="3"
                                                                    class="form-control text-dark h-58 @error('link') border border-danger rounded-3 border-3 @enderror"
                                                                    value="{{ old('link', $dataDetail->link) }}"
                                                                    placeholder="{{ __('dashboard.link') }}" disabled>
                                                            </div>
                                                            @error('link')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label class="label">{{ __('dashboard.title') }}</label>
                                                            <div class="form-group position-relative">
                                                                <input type="text" name="title" maxlength="255"
                                                                    minlength="3"
                                                                    class="form-control text-dark h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                                                                    value="{{ old('title', $dataDetail->title) }}"
                                                                    placeholder="{{ __('dashboard.title') }}" required>
                                                            </div>
                                                            @error('title')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label
                                                                class="label @error('description') text-danger @enderror">{{ __('dashboard.description') }}</label>
                                                            <div class="form-group position-relative">
                                                                <textarea id="description" name="description"
                                                                    class="form-control text-dark  @error('description') border border-danger rounded-3 border-3 @enderror"
                                                                    placeholder="{{ __('dashboard.description') }}" cols="30" rows="4">{{ old('description', $dataDetail->description) }}</textarea>
                                                            </div>
                                                            @error('description')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4" id="imageFormGroup">
                                                            <label
                                                                class="label @error('slug') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                                            <input type="file" class="form-control" id="image"
                                                                name="image" accept="image/*">
                                                            <input type="hidden" id="croppedImage" name="croppedImage"
                                                                value="">
                                                        </div>
                                                        <div id="upload-image-image"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex gap-3">
                                                    <button type="submit" id="subBut"
                                                        class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                        <span class="py-sm-1 d-block">
                                                            <i class="ri-add-line text-white"></i>
                                                            <span>Update</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @break

                                @case('social')
                                    <div class="bg-body px-2 py-3 rounded mb-3">
                                        <form method="post" class="formToSubmit"
                                            action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="record_type" value="social">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label class="form-check-label text-primary" for="flexCheckDefault">
                                                            Add new link
                                                        </label><br>
                                                        <span class="text-muted">Add new link from here, later you can update
                                                            more settings from below list.</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label
                                                            class="label @error('icon') text-danger @enderror">{{ __('dashboard.icon') }}</label>
                                                        <div class="form-group position-relative">
                                                            <select class="form-select form-control h-58" name="icon"
                                                                aria-label="Parent category selection">
                                                                <option class="text-dark">{{ __('dashboard.select') }}
                                                                    {{ __('dashboard.icon') }}</option>

                                                                @foreach ($social as $key => $value)
                                                                    <option value="{{ $value }}" class="text-dark"
                                                                        @if ($value == old('icon')) selected="selected" @endif>
                                                                        {{ $key }}</option>
                                                                @endforeach
                                                            </select>
                                                            <i
                                                                class="position-absolute top-50 start-0 translate-middle-y text-gray-light"></i>
                                                        </div>
                                                        @error('icon')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label">{{ __('dashboard.link') }}</label><br>
                                                        <div class="form-group position-relative">
                                                            <input type="url" name="link" maxlength="255"
                                                                minlength="3"
                                                                class="form-control text-dark h-58 @error('link') border border-danger rounded-3 border-3 @enderror"
                                                                value="{{ old('link') }}"
                                                                placeholder="{{ __('dashboard.link') }}" required>
                                                        </div>
                                                        @error('link')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex gap-3">
                                                <button type="submit" id="subBut"
                                                    class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                    <span class="py-sm-1 d-block">
                                                        <i class="ri-add-line text-white"></i>
                                                        <span>Add link</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <form method="post" class="formToSubmit" action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="record_type" value="links_order">
                                        <input type="hidden" name="record_return_type" value="social">
                                        <ul class="ps-0 mb-0 list-unstyled o-sortable cursor-move chat-list">
                                            @foreach ($links as $key => $value)
                                                <li class="bg-body p-2 rounded-2 mb-3">
                                                    <input type="hidden" name="order[]" value="{{ $value->id }}">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center" style="overflow: hidden">
                                                            <div class="flex-shrink-0 position-relative">
                                                                <div class="rounded bg-dark w48">
                                                                    <div class="text-light pt-2 h4 {{ $value->icon }}"></div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-10">
                                                                <h4 class="fs-16 fw-semibold mb-1">{{ $value->title }}</h4>
                                                                <span class="fs-14 text-primary">{{ $value->link }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="text-end">
                                                            <span class="d-block">
                                                                <a style="cursor: pointer;"
                                                                    onclick="confirmAndDelete('{{ route('dashboard.webpage.delete.main', ['id' => $value->webpage_id, 'section' => 'social', 'sub_id' => $value->id]) }}')">
                                                                    <div class="rounded w48">
                                                                        <div class="text-dark pt-2 h4 bi bi-trash"></div>
                                                                    </div>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        @if(count($links) > 1)
                                            <div class="form-group text-center">
                                                <button type="submit" id="subBut"
                                                    class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                    <span class="py-sm-1 d-block">
                                                        <i class="ri-add-line text-white"></i>
                                                        <span>Save Order</span>
                                                    </span>
                                                </button>
                                            </div>
                                        @endif
                                    </form>
                                @break

                                @case('links')
                                    <div class="bg-body px-2 py-3 rounded mb-3">
                                        <form method="post" class="formToSubmit"
                                            action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="record_type" value="links">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label class="form-check-label text-primary" for="flexCheckDefault">
                                                            Add new link
                                                        </label><br>
                                                        <span class="text-muted">Add new link from here, later you can update
                                                            more settings from below list.</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label">{{ __('dashboard.title') }}</label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="title" maxlength="255"
                                                                minlength="3"
                                                                class="form-control text-dark h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                                                                value="{{ old('title') }}"
                                                                placeholder="{{ __('dashboard.title') }}" required>
                                                        </div>
                                                        @error('title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label">{{ __('dashboard.link') }}</label><br>
                                                        <div class="form-group position-relative">
                                                            <input type="url" name="link" maxlength="255"
                                                                minlength="3"
                                                                class="form-control text-dark h-58 @error('link') border border-danger rounded-3 border-3 @enderror"
                                                                value="{{ old('link') }}"
                                                                placeholder="{{ __('dashboard.link') }}" required>
                                                        </div>
                                                        @error('link')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if (false)
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4" id="imageFormGroup">
                                                            <label
                                                                class="label @error('slug') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                                            <input type="file" class="form-control" id="image"
                                                                name="image" accept="image/*">
                                                            <input type="hidden" id="croppedImage" name="croppedImage"
                                                                value="">
                                                        </div>
                                                        <div id="upload-image-image"></div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group d-flex gap-3">
                                                <button type="submit" id="subBut"
                                                    class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                    <span class="py-sm-1 d-block">
                                                        <i class="ri-add-line text-white"></i>
                                                        <span>Add link</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <form method="post" class="formToSubmit" action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="record_type" value="links_order">
                                        <input type="hidden" name="record_return_type" value="links">
                                        <ul class="ps-0 mb-0 list-unstyled o-sortable cursor-move chat-list">
                                            @foreach ($links as $key => $value)
                                                <li class="bg-body p-2 rounded-2 mb-3">
                                                    <input type="hidden" name="order[]" value="{{ $value->id }}">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center" style="overflow: hidden">
                                                            <div class="flex-shrink-0 position-relative">
                                                                <img src="{{ $value->image() }}" class="wh-48 rounded"
                                                                    alt="user">
                                                            </div>
                                                            <div class="flex-grow-1 ms-10">
                                                                <h4 class="fs-16 fw-semibold mb-1">{{ $value->title }}</h4>
                                                                <span class="fs-14 text-primary">{{ $value->link }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="text-end">
                                                            <span class="d-block">
                                                                @if (true)
                                                                    <a class="p-1" style="cursor: pointer;" id="Btn_Add_User"
                                                                        onclick="updateLink(this)" data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasRight"
                                                                        data-link-id="{{ encrypt($value->id) }}"
                                                                        data-link-link="{{ $value->link }}"
                                                                        data-link-title="{{ $value->title }}"
                                                                        aria-controls="offcanvasRight">
                                                                        <i height="20" data-feather="edit-3"></i>
                                                                    </a><br>
                                                                @endif
                                                                <a class="p-1" style="cursor: pointer;"
                                                                    onclick="confirmAndDelete('{{ route('dashboard.webpage.delete.main', ['id' => $value->webpage_id, 'section' => 'links', 'sub_id' => $value->id]) }}')">
                                                                    <i height="20" data-feather="trash-2"></i>
                                                                </a>
                                                            </span>
                                                            @if (false)
                                                                <span
                                                                    class="fs-12 fw-semibold bg-warning text-white rounded px-1">1220</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @if(count($links) > 1)
                                            <div class="form-group text-center">
                                                <button type="submit" id="subBut"
                                                    class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                    <span class="py-sm-1 d-block">
                                                        <i class="ri-add-line text-white"></i>
                                                        <span>Save Order</span>
                                                    </span>
                                                </button>
                                            </div>
                                        @endif
                                    </form>
                                @break

                                @case('products')
                                    <div class="text-center">
                                        <x-common.empty></x-common.empty>
                                        <h1 class="h2 text-muted">Feature not available!</h1>
                                        <h2 class="h4 mb-5 text-warning">Check after some time.</h2>
                                    </div>
                                @break

                                @case('template')
                                    @if ($templates)
                                        <div class="bg-body px-2 py-3 rounded mb-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label class="form-check-label text-primary" for="flexCheckDefault">
                                                            Add new link
                                                        </label><br>
                                                        <span class="text-muted">Add new link from here, later you can update
                                                            more settings from below list.</span>
                                                    </div>
                                                    <form method="get" id="form">
                                                        {{-- {{ csrf_field() }} --}}
                                                        <div class="row mb-2">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-2">
                                                                    <div class="form-group">
                                                                        <input type="text" name="search"
                                                                            value="{{ old('search', Request::get('search')) }}"
                                                                            class="form-control text-dark"
                                                                            placeholder="Search here">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-8">
                                                                <div class="mb-2">
                                                                    <button type="submit"
                                                                        class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-16 rounded-3">
                                                                        <span class="py-sm-1 d-block">
                                                                            <span>{{ __('dashboard.search') }}</span>
                                                                        </span>
                                                                    </button>
                                                                    <a href="{{ Request::url() }}" type="reset"
                                                                        class="btn btn-outline-secondary hover-white py-2 px-3 px-sm-4 fs-16 rounded-3">
                                                                        <span class="py-sm-1 d-block">
                                                                            <span>{{ __('dashboard.clear') }}</span>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-4 text-end">
                                                                <div class="mb-2">
                                                                    <button type="button" id="templateSelectionFormButton"
                                                                        class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-16 rounded-3">
                                                                        <span class="py-sm-1 d-block">
                                                                            <span>{{ __('dashboard.save') }}</span>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <form method="post" id="templateSelectionForm" class="formToSubmit"
                                                action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="record_type" value="template">
                                                <input type="hidden" name="template_id" id="template_id"
                                                    value="{{ $dataDetail->template_id }}">

                                                <div class="row">
                                                    @foreach ($templates as $data)
                                                        <div class="col-md-3 col-6">
                                                            <div class="pointer rounded-4 p-1 pb-2 templateSingle @if($data->id == $dataDetail->template_id) bg-dark @endif"                                                                
                                                                onclick="selectTemplate(this, {{ $data->id }})">
                                                                <img src="{{ $data->image() }}"
                                                                    class="rounded-4 border border-primary border-3">
                                                                <div class="h6 fw-bold my-2 text-primary">{!! CommonHelper::highLight($data->title) !!}</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <x-common.empty></x-common.empty>
                                            <h1 class="h2 text-muted">Template not available!</h1>
                                            <h2 class="h4 mb-5 text-warning">Try to search different name.</h2>
                                        </div>
                                    @endif
                                @break

                                @case('setting')
                                    <div class="tab-pane fade show active" role="tabpanel" tabindex="0">
                                        <div class="bg-body px-2 py-3 rounded">
                                            <form method="post" class="formToSubmit"
                                                action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="record_type" value="setting">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-4">
                                                            <label class="form-check-label text-danger"
                                                                for="flexCheckDefault">
                                                                SEO details
                                                            </label><br>
                                                            <span class="text-muted">It will be helpful to rank on serch
                                                                engines like (google, bing etc.)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="label">{{ __('dashboard.meta_title') }}</label>
                                                            <div class="form-group position-relative">
                                                                <input type="text" name="meta_title" maxlength="255"
                                                                    minlength="3"
                                                                    class="form-control text-dark h-58 @error('meta_title') border border-danger rounded-3 border-3 @enderror"
                                                                    value="{{ old('meta_title', $dataDetail->meta_title) }}"
                                                                    placeholder="{{ __('dashboard.meta_title') }}">
                                                            </div>
                                                            @error('meta_title')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label
                                                                class="label @error('meta_description') text-danger @enderror">{{ __('dashboard.meta_description') }}</label>
                                                            <div class="form-group position-relative">
                                                                <textarea id="meta_description" name="meta_description"
                                                                    class="form-control text-dark @error('meta_description') border border-danger rounded-3 border-3 @enderror"
                                                                    placeholder="{{ __('dashboard.meta_description') }}" cols="30" rows="3">{{ old('meta_description', $dataDetail->meta_description) }}</textarea>
                                                            </div>
                                                            @error('meta_description')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label
                                                                class="label @error('industry_type_id') text-danger @enderror">{{ __('dashboard.industry') }}</label>
                                                            <div class="form-group position-relative">
                                                                <select class="form-select form-control h-58"
                                                                    name="industry_type_id"
                                                                    aria-label="Parent category selection">
                                                                    <option value="" class="text-dark">
                                                                        {{ __('dashboard.select') }}
                                                                        {{ __('dashboard.industry') }}</option>
                                                                    @foreach ($industries as $data)
                                                                        <option value="{{ $data->id }}" class="text-dark"
                                                                            @if ($data->id == old('industry_type_id', $dataDetail->industry_type_id)) selected="selected" @endif>
                                                                            {{ $data->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('industry_type_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex gap-3">
                                                    <button type="submit" id="subBut"
                                                        class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                        <span class="py-sm-1 d-block">
                                                            <i class="ri-add-line text-white"></i>
                                                            <span>Update</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @break

                                @default
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ __('dashboard.site') }}</h4>
                    <iframe src="{{ env('LINK_APP_URL') . '/' . $dataDetail->link }}" width="100%"
                        class="rounded border" height="580" style="border: none;">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    @if (in_array($section, ['links']))
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header border-bottom p-4">
                <h5 class="offcanvas-title fs-18 mb-0" id="offcanvasRightLabel">Update link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-4">
                <form method="post" class="formToSubmit"
                    action="{{ route('dashboard.webpage.edit.post', ['id' => $dataDetail->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="record_type" name="record_type" value="links">
                    <input type="hidden" id="link-sub-id" name="link_sub_id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label class="form-check-label text-primary" for="flexCheckDefault">
                                    Important
                                </label><br>
                                <span class="text-muted">Keep in mind that once you update record, it will be available
                                    over internet in short time.</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label class="label">{{ __('dashboard.title') }}</label>
                                <div class="form-group position-relative">
                                    <input type="text" id="link-title" name="title" maxlength="255"
                                        minlength="3"
                                        class="form-control text-dark h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                                        value="{{ old('title') }}" placeholder="{{ __('dashboard.title') }}"
                                        required>
                                </div>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label class="label">{{ __('dashboard.link') }}</label><br>
                                <div class="form-group position-relative">
                                    <input type="url" id="link-link" name="link" maxlength="255"
                                        minlength="3"
                                        class="form-control text-dark h-58 @error('link') border border-danger rounded-3 border-3 @enderror"
                                        value="{{ old('link') }}" placeholder="{{ __('dashboard.link') }}"
                                        required>
                                </div>
                                @error('link')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4" id="imageFormGroup">
                                <label
                                    class="label @error('slug') text-danger @enderror">{{ __('dashboard.image') }}</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*">
                                <input type="hidden" id="croppedImage" name="croppedImage" value="">
                            </div>
                            <div id="upload-image-image"></div>
                        </div>
                    </div>
                    <div class="form-group d-flex gap-3">
                        <button type="submit" id="subBut"
                            class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                            <span class="py-sm-1 d-block">
                                <i class="ri-add-line text-white"></i>
                                <span>Update link</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        var $image_crop;
        var isImageSelected = false;
        window.addEventListener('load', function(event) {

            @if ($errors->any())
                var Btn_Add_User = document.getElementById('Btn_Add_User');
                Btn_Add_User.click();
            @endif

            addCropperImage();
            $(".formToSubmit").submit(function(eventObj) {
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
                    width: 120,
                    height: 120,
                    type: 'square'
                },
                boundary: {
                    width: $("#imageFormGroup").width(),
                    height: $("#imageFormGroup").width() / 2
                },
                @if ($section == 'basic')
                    url: '{{ $dataDetail->profile() }}'
                @endif
            });
            $('#image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        isImageSelected = true;
                        console.log('here');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });
        }

        function updateLink(obj) {
            var linkObj = $(obj);
            if (linkObj) {
                $('#link-sub-id').val(linkObj.data("link-id"));
                $('#link-title').val(linkObj.data("link-title"));
                $('#link-link').val(linkObj.data("link-link"));
            } else {

            }
        }

        document.getElementById('templateSelectionFormButton').addEventListener('click', function() {
            const form = document.getElementById('templateSelectionForm');
            form.submit();
        });


        function selectTemplate(elementRef, template_id) {
            const hiddenInput = document.getElementById('template_id');
            hiddenInput.value = template_id;

            const elements = document.querySelectorAll('.templateSingle');
            elements.forEach(element => {
                element.classList.remove('bg-dark');
            });
            elementRef.classList.add('bg-dark')
        }
    </script>

</x-layouts.dashboard>
