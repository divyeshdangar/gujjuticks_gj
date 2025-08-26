<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">{{ __('dashboard.postset') }}</h4>
                <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                    class="border-0 btn btn-primary py-2 px-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>{{ __('dashboard.add') }} {{ __('dashboard.postset') }}</span>
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
                                <th scope="col" class="text-primary">
                                    <label class="form-check-label ms-2"
                                        for="flexCheckDefault">#{{ __('dashboard.id') }}</label>
                                </th>
                                <th scope="col">{{ __('dashboard.image') }}</th>
                                <th scope="col">{{ __('dashboard.topic') }}</th>
                                <th scope="col">{{ __('dashboard.title') }}</th>
                                <th scope="col">{{ __('dashboard.description') }}</th>
                                <th scope="col">{{ __('dashboard.status') }}</th>
                                <th scope="col">{{ __('dashboard.date') }}</th>
                                <th scope="col">{{ __('dashboard.post') }}</th>
                                <th scope="col">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataList as $data)
                                <tr>
                                    <td>
                                        #{{ $data->id }}
                                    </td>
                                    <td width="180px">
                                        <a target="_blank"
                                            href="{{ route('pages.image.postmain', ['slug' => $data->slug . '.jpg']) }}">
                                            <img src="{{ route('pages.image.postmain', ['slug' => $data->slug . '.jpg']) }}"
                                                class="img-thumbnail">
                                        </a>
                                    </td>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold position-relative" style="top: 1px;">
                                                {!! CommonHelper::highLight($data->topic) !!}
                                                <span>
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold position-relative" style="top: 1px;">
                                                {!! CommonHelper::highLight($data->title) !!}
                                                <span>
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold position-relative" style="top: 1px;">
                                                {!! CommonHelper::highLight($data->meta_description) !!}
                                                <span>
                                        </div>
                                    </td>
                                    <td>
                                        {!! $data->getStatus(true) !!}
                                    </td>
                                    <td>
                                        {{ $data->created_at->format('j F, Y') }}
                                    </td>
                                    <td>
                                        @if ($data->isPostedByLoginUser())
                                            <button class="btn bg-warning link-dark">
                                                Published
                                            </button>
                                        @else
                                            <a class="btn bg-dark link-light"
                                                href="{{ route('dashboard.postset.publish', ['id' => $data->id]) }}">
                                                Post
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown action-opt">
                                            @if ($data->deleted_at == null)
                                                <a class="btn bg p-1"
                                                    href="{{ route('dashboard.postset.edit', ['id' => $data->id]) }}">
                                                    <i data-feather="edit-3"></i>
                                                </a>
                                                <a class="btn bg p-1"
                                                    href="{{ route('dashboard.postset.list', ['id' => $data->id]) }}">
                                                    <i data-feather="list"></i>
                                                </a>
                                                <a class="btn bg p-1"
                                                    onclick="confirmAndDelete('{{ route('dashboard.postset.delete', ['id' => $data->id]) }}')">
                                                    <i data-feather="trash-2"></i>
                                                </a>
                                            @else
                                                <a title="Restore" class="btn bg p-1"
                                                    onclick="confirmAndDelete('{{ route('dashboard.postset.restore', ['id' => $data->id]) }}', 'restore')">
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
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-4">
            <h5 class="offcanvas-title fs-18 mb-0" id="offcanvasRightLabel">Request Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <form method="post" action="{{ route('dashboard.postset.add.post') }}">
                {{ csrf_field() }}
                <div class="form-group mb-4">
                    <label class="form-check-label text-danger" for="flexCheckDefault">
                        Important Note
                    </label><br>
                    <span class="text-muted">Ensure you copy the prompt accurately and paste only the array response
                        into the field named <span class="text-warning">data</span>. Verify that the array contains only
                        valid data - no comments or any other extraneous content.</span>
                </div>
                <div class="mb-3">
                    <label for="topic" class="form-label">Topic</label>
                    <textarea name="topic" id="topic" class="form-control" rows="10" style="width: 100%">{{ old('topic') }}</textarea>
                    @error('topic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group d-flex gap-3">
                    <button type="submit" class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line text-white"></i>
                            <span>Add Post</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.dashboard>
