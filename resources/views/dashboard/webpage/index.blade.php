<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">{{ __('dashboard.links') }}</h4>
                <button id="Btn_Add_Record"
                    class="border-0 btn btn-primary py-2 px-4 text-white fs-14 fw-semibold rounded-3"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Link</span>
                    </span>
                </button>
            </div>
            <div class="default-table-area notification-list">
                <form method="get" id="form">
                    {{-- {{ csrf_field() }} --}}
                    <div class="row mb-2">
                        <div class="col-lg-3">
                            <div class="form-group mb-2">
                                <div class="form-group">
                                    <input type="text" name="search"
                                        value="{{ old('search', Request::get('search')) }}"
                                        class="form-control text-dark" placeholder="Search here">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
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
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('dashboard.image') }}</th>
                                <th scope="col">{{ __('dashboard.title') }}</th>
                                <th scope="col">{{ __('dashboard.date') }}</th>
                                <th scope="col">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataList as $data)
                                <tr>
                                    <td>
                                        <a target="_blank" href="{{ $data->profile() }}">
                                            <img src="{{ $data->profile() }}" class="wh-60 rounded-circle">
                                        </a>
                                    </td>
                                    <td>
                                        {!! CommonHelper::highLight($data->title) !!}
                                        <div class="d-flex align-items-center">
                                            <a target="_BLANK" href="https://gujju.me/{{ $data->link }}"><span
                                                    class="text-muted"><i class="ri-link"></i>
                                                    https://gujju.me/</span><span
                                                    class="fw-semibold position-relativ text-primary"
                                                    style="top: 1px;">{!! CommonHelper::highLight($data->link) !!}</span></a>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $data->created_at->format('j F, Y') }}
                                    </td>
                                    <td>
                                        <div class="dropdown action-opt">
                                            
                                            @if($data->deleted_at == null)
                                                {{-- <a class="btn bg p-1" href="{{ route('dashboard.webpage.refresh', ['id' => $data->id]) }}">
                                                    <i data-feather="refresh-cw"></i>
                                                </a> --}}
                                                <a class="btn bg p-1" href="{{ route('dashboard.webpage.edit', ['id' => $data->id]) }}">
                                                    <i data-feather="edit-3"></i>
                                                </a>
                                                {{-- <a class="btn bg p-1" href="{{ route('dashboard.webpage.analytics', ['id' => $data->id]) }}">
                                                    <i data-feather="bar-chart-2"></i>
                                                </a> --}}
                                                <a class="btn bg p-1" onclick="confirmAndDelete('{{ route('dashboard.webpage.delete', ['id' => $data->id]) }}')">
                                                    <i data-feather="trash-2"></i>
                                                </a>
                                            @else
                                                <a title="Restore" class="btn bg p-1"
                                                    onclick="confirmAndDelete('{{ route('dashboard.webpage.restore', ['id' => $data->id]) }}', 'restore')">
                                                    <i data-feather="rotate-ccw"></i>
                                                </a>                                            
                                            @endif
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $dataList->links('vendor.pagination.bootstrap-5') }}
            </div>
            @if (count($dataList) == 0)
                <x-common.empty></x-common.empty>
            @endif
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-4">
            <h5 class="offcanvas-title fs-18 mb-0" id="offcanvasRightLabel">Add Link</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <form method="post" action="{{ route('dashboard.webpage.create') }}">
                {{ csrf_field() }}
                <div class="form-group mb-4">
                    <label class="form-check-label text-danger" for="flexCheckDefault">
                        Important Note
                    </label><br>
                    <span class="text-muted">It must be original google email address, as for now we only support google
                        login.</span>
                </div>
                <div class="form-group mb-4">
                    <label class="label">{{ __('dashboard.title') }}</label>
                    <div class="form-group position-relative">
                        <input type="text" name="title" maxlength="255" minlength="3"
                            class="form-control text-dark h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                            value="{{ old('title') }}" placeholder="{{ __('dashboard.title') }}" required>
                    </div>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="label mb-0">{{ __('dashboard.link') }}</label><br>
                    <small class="mb-1 text-muted">https://gujju.me/<span class="text-primary fw-bold"
                            id="link"></span></small>
                    <div class="form-group position-relative">
                        <input type="text" onkeyup="updateUrl(this, 'link')" name="link" maxlength="255"
                            minlength="3"
                            class="form-control text-dark h-58 @error('link') border border-danger rounded-3 border-3 @enderror"
                            value="{{ old('link') }}" placeholder="{{ __('dashboard.link') }}" required>
                        <span class="text-danger d-none" id="link-error">
                            <ul class="mt-1">
                                <li>Invalid link</li>
                                <li>Must be at least 4 characters long</li>
                                <li>Start with a letter</li>
                                <li>Can include numbers and single hyphens</li>
                                <li>Must end with a letter or number</li>
                            </ul>
                        </span>
                    </div>
                    @error('link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label
                        class="label @error('description') text-danger @enderror">{{ __('dashboard.description') }}</label>
                    <div class="form-group position-relative">
                        <textarea id="description" name="description"
                            class="form-control text-dark  @error('description') border border-danger rounded-3 border-3 @enderror"
                            placeholder="{{ __('dashboard.description') }}" cols="30" rows="4">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group d-flex gap-3">
                    <button type="submit" id="subBut"
                        class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line text-white"></i>
                            <span>Add Link</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('load', function(event) {
            @if ($errors->any())
                var Btn_Add_Record = document.getElementById('Btn_Add_Record');
                Btn_Add_Record.click();
            @endif

        });

        function updateUrl(obj, id) {
            var link = $(obj).val();
            const error = $("#link-error");
            const subBut = $("#subBut");
            const linkPattern = /^[a-zA-Z](?!.*--)[a-zA-Z0-9-]{2,}[a-zA-Z0-9]$/;
            if (!linkPattern.test(link)) {
                error.removeClass('d-none');
                $('#' + id).html('');
                subBut.hide();
            } else {
                $('#' + id).html(link);
                error.addClass('d-none');
                subBut.show();
            }
        }
    </script>
</x-layouts.dashboard>
